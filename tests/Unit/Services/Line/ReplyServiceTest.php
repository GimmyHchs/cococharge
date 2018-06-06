<?php

namespace Tests\Unit\Services\Line;

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
}
