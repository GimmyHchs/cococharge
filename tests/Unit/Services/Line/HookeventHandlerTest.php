<?php

namespace Tests\Unit\Services\Line;

use App\Eloquents\Line\JoinEvent;
use App\Services\Line\HookeventHandler;
use App\Services\Line\WebhookParsers\JoinParser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Log;
use Tests\TestCase;

class HookeventHandlerTest extends TestCase
{
    use RefreshDatabase;

    protected $mock_events;

    public function setUp()
    {
        parent::setUp();
        $message_json = '
            {
                "events": [
                    {
                        "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
                        "type": "join",
                        "timestamp": 1462629479859,
                        "source": {
                            "type": "group",
                            "groupId": "C8900d40ace9ee5d64f93120330ad8872"
                        }
                    }
                ]
            }';
        $this->mock_events = json_decode($message_json, true)['events'];
    }

    public function testHandle()
    {
        $join_event = factory(JoinEvent::class)->make();
        $this->mock(JoinParser::class)
            ->shouldReceive('parse')
            ->with($this->mock_events[0], false)
            ->once()
            ->andReturn($join_event);
        $handler = app(HookeventHandler::class);

        $collection = $handler->handle($this->mock_events);

        $this->assertEquals(1, $collection->count());
        $this->assertEquals($join_event, $collection->first());
    }

    public function testHandleUndefinedType()
    {
        Log::shouldReceive('error')
            ->once();

        $this->mock_events[0]['type'] = 'error-type';

        $handler = app(HookeventHandler::class);

        $collection = $handler->handle($this->mock_events);

        $this->assertEquals(0, $collection->count());
    }

    public function testGetFirstToken()
    {
        $join_event = factory(JoinEvent::class)->make();
        $this->mock(JoinParser::class)
            ->shouldReceive('parse')
            ->andReturn($join_event);
        $handler = app(HookeventHandler::class);

        $handler->handle($this->mock_events);

        $this->assertEquals($join_event->reply_token, $handler->getFirstReplyToken());
    }
}
