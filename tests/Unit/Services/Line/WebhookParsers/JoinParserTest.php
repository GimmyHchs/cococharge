<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Eloquents\Line\JoinEvent;
use App\Services\Line\WebhookParsers\JoinParser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JoinTest extends TestCase
{
    use RefreshDatabase;

    protected $mock_event;

    public function setUp()
    {
        parent::setUp();
        $event_json = '
            {
                "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
                "type": "join",
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
        $parser = app(JoinParser::class);
        $event = $parser->parse($this->mock_event);

        $this->assertInstanceOf(JoinEvent::class, $event);
        $this->assertEquals('nHuyWiB7yP5Zw52FIkcQobQuGDXCTA', $event->reply_token);
        $this->assertEquals('join', $event->type);
        $this->assertEquals('1462629479859', $event->timestamp);
        $this->assertEquals('group', $event->source_type);
        $this->assertEquals('C8900d40ace9ee5d64f93120330ad8872', $event->source_id);
    }

    public function testParseAndAutoSave()
    {
        $parser = app(JoinParser::class);
        $parser->parse($this->mock_event, true);

        $this->assertEquals(1, JoinEvent::all()->count());
    }
}
