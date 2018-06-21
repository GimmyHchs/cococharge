<?php

namespace Tests\Unit\Services\Line\WebhookParsers\MessageGenerators;

use App\Exceptions\Line\UndefinedMessageTypeException;
use App\Services\Line\WebhookParsers\MessageGenerators\GeneratorFactory;
use App\Services\Line\WebhookParsers\MessageGenerators\StickerGenerator;
use App\Services\Line\WebhookParsers\MessageGenerators\TextGenerator;
use Exception;
use Tests\TestCase;

class GeneratorFactoryTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(TextGenerator::class, GeneratorFactory::make('text'));
        $this->assertInstanceOf(StickerGenerator::class, GeneratorFactory::make('sticker'));
    }

    public function testMakeWillThrowException()
    {
        try {
            GeneratorFactory::make('error-type');
        } catch (Exception $e) {
            $this->assertInstanceOf(UndefinedMessageTypeException::class, $e);
            $this->assertEquals('undefined message type [error-type]', $e->getMessage());
        }
    }
}
