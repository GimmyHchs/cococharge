<?php

namespace Tests\Unit\Services\Line\WebhookParsers\MessageGenerators;

use App\Eloquents\Line\Messages\Text;
use App\Services\Line\WebhookParsers\MessageGenerators\TextGenerator;
use Tests\TestCase;

class TextGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $message_json = '
            {
                "id": "325708",
                "type": "text",
                "text": "Hello, world!"
            }';
        $message = json_decode($message_json, true);

        $generator = app(TextGenerator::class);
        $result = $generator->generate($message);

        $this->assertInstanceOf(Text::class, $result);
        $this->assertEquals('325708', $result->message_id);
        $this->assertEquals('text', $result->type);
        $this->assertEquals('Hello, world!', $result->text);
    }
}
