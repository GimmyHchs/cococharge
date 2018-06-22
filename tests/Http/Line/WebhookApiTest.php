<?php

namespace Tests\Http\Line;

use App\Services\Line\HookeventHandler;
use App\Services\SyntaxGate\ActionDispatcher;
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

        $this->mock(ActionDispatcher::class)
            ->shouldReceive('setEvent')
            ->once()
            ->andReturn(null)
            ->shouldReceive('dispatchActions')
            ->once()
            ->andReturn(null);

        $response = $this->post(route('line.webhook'), ['events' => []]);
        $response->assertStatus(200);
    }
}
