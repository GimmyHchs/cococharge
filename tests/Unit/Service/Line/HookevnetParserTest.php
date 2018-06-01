<?php

namespace Tests\Unit\Service\Line;

use App\Service\Line\HookeventParser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HookevnetParserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    protected $mockJson;

    public function setUp()
    {
        parent::setUp();
        $messageJson = '
        {
            "events": [
                {
                    "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
                    "type": "message",
                    "timestamp": 1462629479859,
                    "source": {
                        "type": "user",
                        "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
                    },
                    "message": {
                        "id": "325708",
                        "type": "text",
                        "text": "Hello, world"
                    }
                },
                {
                    "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
                    "type": "follow",
                    "timestamp": 1462629479859,
                    "source": {
                    "type": "user",
                    "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
                    }
                }
            ]
        }';
        $this->mockHookevents = json_decode($messageJson, true)['events'];
    }

    public function testParseJson()
    {
        $collections = HookeventParser::parse($this->mockHookevents);

        $this->assertEquals('1462629479859', $collections->first()->timestamp);
        $this->assertEquals('message', $collections->first()->type);
    }
}
