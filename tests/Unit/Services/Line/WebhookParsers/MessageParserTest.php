<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Eloquents\Line\MessageEvent;
use App\Eloquents\Line\Messages\LineSticker;
use App\Eloquents\Line\Messages\LineText;
use App\Services\Line\WebhookParsers\MessageParser;
use App\Services\Line\WebhookParsers\MessageParsers\StickerParser;
use App\Services\Line\WebhookParsers\MessageParsers\TextParser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;

class MessageParserTest extends TestCase
{
    use RefreshDatabase;

    public function testParse()
    {
        $parser = app(MessageParser::class);
        $expectCarbon = Carbon::createFromTimestamp(intval(1462629479859 / 1000));
        $this->mock(TextParser::class)
            ->shouldReceive('parse')
            ->once()
            ->andReturn(factory(LineText::class)->make());

        $event = $parser->parse($this->getTextMockEvent());

        $this->assertInstanceOf(MessageEvent::class, $event);
        $this->assertInstanceOf(stdClass::class, $event->origin_data);
        $this->assertEquals('nHuyWiB7yP5Zw52FIkcQobQuGDXCTA', $event->reply_token);
        $this->assertEquals('message', $event->type);
        $this->assertEquals('text', $event->message_type);
        $this->assertEquals($expectCarbon->toDateTimeString(), $event->timestamp->toDateTimeString());
        $this->assertEquals('user', $event->source_type);
        $this->assertEquals('C8900d40ace9ee5d64f93120330ad8872', $event->source_id);
    }

    public function testParseAndAutoSave()
    {
        $mock_text = factory(LineText::class)->make();
        $this->mock(TextParser::class)
            ->shouldReceive('parse')
            ->once()
            ->andReturn($mock_text);

        $parser = app(MessageParser::class);
        $parser->parse($this->getTextMockEvent(), true);

        $this->assertEquals(1, MessageEvent::all()->count());
    }

    public function testParseAndAutoSaveWitRelation()
    {
        $mock_text = factory(LineText::class)->make();
        $this->mock(TextParser::class)
            ->shouldReceive('parse')
            ->once()
            ->andReturn($mock_text);

        $parser = app(MessageParser::class);
        $parser->parse($this->getTextMockEvent(), true);
        $this->assertEquals(MessageEvent::first()->id, $mock_text->event_id);
    }

    public function testParseWithText()
    {
        $mock_text = factory(LineText::class)->make();
        $parser = app(MessageParser::class);
        $this->mock(TextParser::class)
            ->shouldReceive('parse')
            ->once()
            ->andReturn($mock_text);

        $event = $parser->parse($this->getTextMockEvent());
        $this->assertEquals($mock_text->text, $event->lineText->text);
    }

    public function testParseWithSticker()
    {
        $mock_sticker = factory(LineSticker::class)->make();
        $parser = app(MessageParser::class);
        $this->mock(StickerParser::class)
            ->shouldReceive('parse')
            ->once()
            ->andReturn($mock_sticker);

        $event = $parser->parse($this->getStickerMockEvent());
        $this->assertEquals($mock_sticker->package_id, $event->lineSticker->package_id);
    }

    private function getTextMockEvent()
    {
        $eventJson = '
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

        return json_decode($eventJson, true);
    }

    private function getStickerMockEvent()
    {
        $eventJson = '
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
                    "type": "sticker",
                    "packageId": "1",
                    "stickerId": "1"
                }
            }';

        return json_decode($eventJson, true);
    }
}
