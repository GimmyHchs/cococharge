<?php

namespace Tests\Unit\Services\Line\WebhookParsers\MessageGenerators;

use App\Eloquents\Line\Messages\LineText;
use App\Services\Line\WebhookParsers\MessageGenerators\TextGenerator;
use Tests\TestCase;

class TextGeneratorTest extends TestCase
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

        $generator = app(TextGenerator::class);
        $result = $generator->generate($message);

        $this->assertInstanceOf(LineText::class, $result);
        $this->assertEquals('325708', $result->message_id);
        $this->assertEquals('text', $result->type);
        $this->assertEquals('Hello, world!', $result->text);
    }
}
