<?php

namespace Tests\Http\Line;

use App\Services\Line\HookeventParser;
use App\Services\Line\ReplyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LINE\LINEBot\Response;
use Tests\TestCase;

class WebhookApiTest extends TestCase
{
    use RefreshDatabase;

    public function testPostToWebhookReturn200()
    {
        $this->mock(HookeventParser::class)
            ->shouldReceive('parse')
            ->once()
            ->andReturn(collect())
            ->shouldReceive('getFirstReplyToken')
            ->once()
            ->andReturn('');

        $this->mock(ReplyService::class)
            ->shouldReceive('setToken')
            ->andReturn(null)
            ->shouldReceive('sendText')
            ->andReturn(new Response(200, 'mock-body'));

        $response = $this->post(route('line.webhook'), ['events' => []]);
        $response->assertStatus(200);
    }
}
