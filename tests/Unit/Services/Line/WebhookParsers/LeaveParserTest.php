<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Eloquents\Line\LeaveEvent;
use App\Services\Line\WebhookParsers\LeaveParser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;

class LeaveParserTest extends TestCase
{
    use RefreshDatabase;

    protected $mock_event;

    public function setUp()
    {
        parent::setUp();
        $event_json = '
            {
                "type": "leave",
                "timestamp": 1462629479859,
                "source": {
                    "type": "group",
                    "groupId": "C8900d40ace9ee5d64f93120330ad8872"
                }
            }';
        $this->mock_event = json_decode($event_json, true);
    }

    public function testParse()
    {
        $parser = app(LeaveParser::class);
        $event = $parser->parse($this->mock_event);
        $expectCarbon = Carbon::createFromTimestamp(intval(1462629479859 / 1000));
        $this->assertInstanceOf(LeaveEvent::class, $event);
        $this->assertInstanceOf(stdClass::class, $event->origin_data);
        $this->assertEquals('leave', $event->type);
        $this->assertEquals($expectCarbon->toDateTimeString(), $event->timestamp->toDateTimeString());
        $this->assertEquals('group', $event->source_type);
        $this->assertEquals('C8900d40ace9ee5d64f93120330ad8872', $event->source_id);
    }

    public function testParseAndAutoSave()
    {
        $parser = app(LeaveParser::class);
        $parser->parse($this->mock_event, true);

        $this->assertEquals(1, LeaveEvent::all()->count());
    }
}
