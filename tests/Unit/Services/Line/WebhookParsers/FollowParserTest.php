<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Eloquents\Line\FollowEvent;
use App\Services\Line\WebhookParsers\FollowParser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;

class FollowParserTest extends TestCase
{
    use RefreshDatabase;

    protected $mockEvent;

    public function setUp()
    {
        parent::setUp();
        $eventJson = '
            {
                "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
                "type": "follow",
                "timestamp": 1462629479859,
                "source": {
                    "type": "user",
                    "userId": "C8900d40ace9ee5d64f93120330ad8872"
                }
            }';
        $this->mockEvent = json_decode($eventJson, true);
    }

    public function testParse()
    {
        $parser = app(FollowParser::class);
        $event = $parser->parse($this->mockEvent);
        $expectCarbon = Carbon::createFromTimestamp(intval(1462629479859 / 1000));
        $this->assertInstanceOf(FollowEvent::class, $event);
        $this->assertInstanceOf(stdClass::class, $event->origin_data);
        $this->assertEquals('nHuyWiB7yP5Zw52FIkcQobQuGDXCTA', $event->reply_token);
        $this->assertEquals('follow', $event->type);
        $this->assertEquals($expectCarbon->toDateTimeString(), $event->timestamp->toDateTimeString());
        $this->assertEquals('user', $event->source_type);
        $this->assertEquals('C8900d40ace9ee5d64f93120330ad8872', $event->source_id);
    }

    public function testParseAndAutoSave()
    {
        $parser = app(FollowParser::class);
        $parser->parse($this->mockEvent, true);

        $this->assertEquals(1, FollowEvent::all()->count());
    }
}
