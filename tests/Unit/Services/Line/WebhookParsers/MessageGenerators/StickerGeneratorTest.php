<?php

namespace Tests\Unit\Services\Line\WebhookParsers\MessageGenerators;

use App\Eloquents\Line\Messages\LineSticker;
use App\Services\Line\WebhookParsers\MessageGenerators\StickerGenerator;
use Tests\TestCase;

class StickerGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $messageJson = '
            {
                "id": "325708",
                "type": "sticker",
                "packageId": "1",
                "stickerId": "1"
            }';
        $message = json_decode($messageJson, true);

        $generator = app(StickerGenerator::class);
        $result = $generator->generate($message);

        $this->assertInstanceOf(LineSticker::class, $result);
        $this->assertEquals('325708', $result->message_id);
        $this->assertEquals('sticker', $result->type);
        $this->assertEquals('1', $result->sticker_id);
        $this->assertEquals('1', $result->package_id);
    }
}
