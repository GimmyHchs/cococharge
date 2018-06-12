<?php

namespace Tests\Http\Line;

use App\Services\Line\HookeventHandler;
use App\Services\Line\ReplyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LINE\LINEBot\Response;
use Tests\TestCase;

class WebhookApiTest extends TestCase
{
    use RefreshDatabase;

    public function testPostToWebhookReturn200WithBody()
    {
        $this->mock(HookeventHandler::class)
            ->shouldReceive('handle')
            ->once()
            ->andReturn(collect())
            ->shouldReceive('getFirstReplyToken')
            ->once()
            ->andReturn('mock-token');

        $this->mock(ReplyService::class)
            ->shouldReceive('setToken')
            ->once()
            ->andReturn(null)
            ->shouldReceive('sendText')
            ->once()
            ->andReturn(new Response(200, 'mock-body'));

        $response = $this->post(route('line.webhook'), ['events' => []]);
        $response->assertStatus(200);
        $response->assertSee('mock-body');
    }

    public function testPostToWebhookReturn200NoToken()
    {
        $this->mock(HookeventHandler::class)
            ->shouldReceive('handle')
            ->once()
            ->andReturn(collect())
            ->shouldReceive('getFirstReplyToken')
            ->once()
            ->andReturn('');

        $response = $this->post(route('line.webhook'), ['events' => []]);
        $response->assertStatus(200);
        $response->assertSee('');
    }
}
