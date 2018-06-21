<?php

namespace Tests\Http\Line;

use App\Services\Line\HookeventHandler;
use App\Services\Line\ReplyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebhookApiTest extends TestCase
{
    use RefreshDatabase;

    public function testPostToWebhookReturn200WithBody()
    {
        $this->mock(HookeventHandler::class)
            ->shouldReceive('handle')
            ->once()
            ->andReturn(collect());

        $this->mock(ReplyService::class)
            ->shouldReceive('replyByEvents')
            ->once()
            ->andReturn(0);

        $response = $this->post(route('line.webhook'), ['events' => []]);
        $response->assertStatus(200);
    }
}
