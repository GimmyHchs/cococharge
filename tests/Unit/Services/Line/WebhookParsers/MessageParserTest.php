<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Eloquents\Line\MessageEvent;
use App\Services\Line\WebhookParsers\MessageParser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;

class MessageParserTest extends TestCase
{
    use RefreshDatabase;

    protected $mock_event;

    public function setUp()
    {
        parent::setUp();
        $event_json = '
            {
                "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
                "type": "message",
                "timestamp": 1462629479859,
                "source": {
                    "type": "user",
                    "userId": "C8900d40ace9ee5d64f93120330ad8872"
                },
                "message": {
                    "id": "325708",
                    "type": "text",
                    "text": "Hello, world!"
                }
            }';
        $this->mock_event = json_decode($event_json, true);
    }

    public function testParse()
    {
        $parser = app(MessageParser::class);
        $event = $parser->parse($this->mock_event);
        $expectCarbon = Carbon::createFromTimestamp(intval(1462629479859 / 1000));
        $this->assertInstanceOf(MessageEvent::class, $event);
        $this->assertInstanceOf(stdClass::class, $event->origin_data);
        $this->assertEquals('nHuyWiB7yP5Zw52FIkcQobQuGDXCTA', $event->reply_token);
        $this->assertEquals('message', $event->type);
        $this->assertEquals($expectCarbon->toDateTimeString(), $event->timestamp->toDateTimeString());
        $this->assertEquals('user', $event->source_type);
        $this->assertEquals('C8900d40ace9ee5d64f93120330ad8872', $event->source_id);
    }

    public function testParseAndAutoSave()
    {
        $parser = app(MessageParser::class);
        $parser->parse($this->mock_event, true);

        $this->assertEquals(1, MessageEvent::all()->count());
    }
}
