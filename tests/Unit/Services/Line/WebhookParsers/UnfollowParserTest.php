<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Eloquents\Line\UnfollowEvent;
use App\Services\Line\WebhookParsers\UnfollowParser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;

class UnfollowParserTest extends TestCase
{
    use RefreshDatabase;

    protected $mockEvent;

    public function setUp()
    {
        parent::setUp();
        $eventJson = '
            {
                "type": "unfollow",
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
        $parser = app(UnfollowParser::class);
        $event = $parser->parse($this->mockEvent);
        $expectCarbon = Carbon::createFromTimestamp(intval(1462629479859 / 1000));
        $this->assertInstanceOf(UnfollowEvent::class, $event);
        $this->assertInstanceOf(stdClass::class, $event->origin_data);
        $this->assertEquals('unfollow', $event->type);
        $this->assertEquals($expectCarbon->toDateTimeString(), $event->timestamp->toDateTimeString());
        $this->assertEquals('user', $event->source_type);
        $this->assertEquals('C8900d40ace9ee5d64f93120330ad8872', $event->source_id);
    }

    public function testParseAndAutoSave()
    {
        $parser = app(UnfollowParser::class);
        $parser->parse($this->mockEvent, true);

        $this->assertEquals(1, UnfollowEvent::all()->count());
    }
}
