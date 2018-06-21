<?php

namespace Tests\Unit\Services\Line;

use App\Eloquents\Line\LeaveEvent;
use App\Eloquents\Line\MessageEvent;
use App\Services\Line\LineBot;
use App\Services\Line\ReplyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LINE\LINEBot\Response;
use Tests\TestCase;

class ReplyServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testSendText()
    {
        $reply_token = 'mock-token';
        $message = 'mock-message';
        $response = new Response(200, 'mock-response');
        $this->mock(LineBot::class)
            ->shouldReceive('replyText')
            ->with($reply_token, $message)
            ->once()
            ->andReturn($response);

        $service = app(ReplyService::class);
        $service->setToken($reply_token);
        $result = $service->sendText($message);

        $this->assertEquals('mock-response', $result->getRawBody());
        $this->assertEquals(200, $result->getHttpStatus());
    }

    public function testReplyByEventsWillNothingToReply()
    {
        $this->mock(LineBot::class);
        $events = factory(LeaveEvent::class, 5)->create();
        $service = app(ReplyService::class);
        $countOfReplied = $service->replyByEvents($events);

        $this->assertEquals(0, $countOfReplied);
    }

    public function testReplyByStickerMessageEvents()
    {
        $this->mock(LineBot::class)
            ->shouldReceive('replySticker')
            ->twice()
            ->andReturn(new Response(200, ''));

        $events = factory(MessageEvent::class, 2)->create([
            'message_type' => 'sticker',
        ]);
        $service = app(ReplyService::class);
        $countOfReplied = $service->replyByEvents($events);

        $this->assertEquals(2, $countOfReplied);
    }

    public function testReplyByOtherMessageEvents()
    {
        $this->mock(LineBot::class)
            ->shouldReceive('replyText')
            ->twice()
            ->andReturn(new Response(200, ''));

        $events = factory(MessageEvent::class, 2)->create([
            'message_type' => 'other',
        ]);
        $service = app(ReplyService::class);
        $countOfReplied = $service->replyByEvents($events);

        $this->assertEquals(2, $countOfReplied);
    }
}
