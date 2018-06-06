<?php

namespace Tests\Unit\Services\Line;

use App\Services\Line\HookeventParser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HookevnetParserTest extends TestCase
{
    use RefreshDatabase;

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
        $parser = app(HookeventParser::class);
        $collections = $parser->parse($this->mockHookevents);

        $this->assertEquals('1462629479859', $collections->first()->timestamp);
        $this->assertEquals('message', $collections->first()->type);
        $this->assertEquals('325708', $collections->first()->message->id);
    }
}
