<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Eloquents\Line\JoinEvent;
use App\Services\Line\WebhookParsers\JoinParser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;

class JoinParserTest extends TestCase
{
    use RefreshDatabase;

    protected $mockEvent;

    public function setUp()
    {
        parent::setUp();
        $eventJson = '
            {
                "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
                "type": "join",
                "timestamp": 1462629479859,
                "source": {
                    "type": "group",
                    "groupId": "C8900d40ace9ee5d64f93120330ad8872"
                }
            }';
        $this->mockEvent = json_decode($eventJson, true);
    }

    public function testParse()
    {
        $parser = app(JoinParser::class);
        $event = $parser->parse($this->mockEvent);
        $expectCarbon = Carbon::createFromTimestamp(intval(1462629479859 / 1000));
        $this->assertInstanceOf(JoinEvent::class, $event);
        $this->assertInstanceOf(stdClass::class, $event->origin_data);
        $this->assertEquals('nHuyWiB7yP5Zw52FIkcQobQuGDXCTA', $event->reply_token);
        $this->assertEquals('join', $event->type);
        $this->assertEquals($expectCarbon->toDateTimeString(), $event->timestamp->toDateTimeString());
        $this->assertEquals('group', $event->source_type);
        $this->assertEquals('C8900d40ace9ee5d64f93120330ad8872', $event->source_id);
    }

    public function testParseAndAutoSave()
    {
        $parser = app(JoinParser::class);
        $parser->parse($this->mockEvent, true);

        $this->assertEquals(1, JoinEvent::all()->count());
    }
}
