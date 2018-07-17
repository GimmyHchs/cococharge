<?php

namespace Tests\Unit\Services\Line\WebhookParsers\MessageParsers;

use App\Eloquents\Line\Messages\LineText;
use App\Services\Line\WebhookParsers\MessageParsers\TextParser;
use Tests\TestCase;

class TextParserTest extends TestCase
{
    public function testGenerate()
    {
        $messageJson = '
            {
                "id": "325708",
                "type": "text",
                "text": "Hello, world!"
            }';
        $message = json_decode($messageJson, true);

        $parser = app(TextParser::class);
        $result = $parser->parse($message);

        $this->assertInstanceOf(LineText::class, $result);
        $this->assertEquals('325708', $result->message_id);
        $this->assertEquals('text', $result->type);
        $this->assertEquals('Hello, world!', $result->text);
    }
}
