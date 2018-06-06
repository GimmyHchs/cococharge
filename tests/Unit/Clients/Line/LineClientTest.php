<?php

namespace Tests\Unit\Services\Line;

use App\Http\Clients\Line\LineClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LINE\LINEBot\Response as LineResponse;
use Tests\TestCase;

class LineClientTest extends TestCase
{
    use RefreshDatabase;

    public function testGet()
    {
        $mockHandlerResult = new MockHandler([
            new Response(200, [], 'mock body string'),
        ]);
        $mockHandler = HandlerStack::create($mockHandlerResult);

        $client = new LineClient(['handler' => $mockHandler]);

        $response = $client->get('/');

        $this->assertInstanceOf(LineResponse::class, $response);
        $this->assertEquals(200, $response->getHTTPStatus());
        $this->assertEquals('mock body string', $response->getRawBody());
    }

    public function testPost()
    {
        $mockHandlerResult = new MockHandler([
            new Response(200, [], 'mock body string'),
        ]);
        $mockHandler = HandlerStack::create($mockHandlerResult);

        $client = new LineClient(['handler' => $mockHandler]);

        $response = $client->post('/', ['test' => 'test']);

        $this->assertInstanceOf(LineResponse::class, $response);
        $this->assertEquals(200, $response->getHTTPStatus());
        $this->assertEquals('mock body string', $response->getRawBody());
    }
}
