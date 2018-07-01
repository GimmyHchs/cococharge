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

    protected $mockEvents;

    public function setUp()
    {
        parent::setUp();
        $messageJson = '
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
        $this->mockEvents = json_decode($messageJson, true)['events'];
    }

    public function testHandle()
    {
        $joinEvent = factory(JoinEvent::class)->make();
        $this->mock(JoinParser::class)
            ->shouldReceive('parse')
            ->with($this->mockEvents[0], false)
            ->once()
            ->andReturn($joinEvent);
        $handler = app(HookeventHandler::class);

        $collection = $handler->handle($this->mockEvents);

        $this->assertEquals(1, $collection->count());
        $this->assertEquals($joinEvent, $collection->first());
    }

    public function testHandleUndefinedType()
    {
        Log::shouldReceive('error')
            ->once();

        $this->mockEvents[0]['type'] = 'error-type';

        $handler = app(HookeventHandler::class);

        $collection = $handler->handle($this->mockEvents);

        $this->assertEquals(0, $collection->count());
    }

    public function testGetFirstToken()
    {
        $joinEvent = factory(JoinEvent::class)->make();
        $this->mock(JoinParser::class)
            ->shouldReceive('parse')
            ->andReturn($joinEvent);
        $handler = app(HookeventHandler::class);

        $handler->handle($this->mockEvents);

        $this->assertEquals($joinEvent->reply_token, $handler->getFirstReplyToken());
    }
}
