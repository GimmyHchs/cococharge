<?php

namespace Tests\Unit\Services\Line\WebhookParsers\MessageParsers;

use App\Exceptions\Line\UndefinedMessageTypeException;
use App\Services\Line\WebhookParsers\MessageParsers\ParserFactory;
use App\Services\Line\WebhookParsers\MessageParsers\StickerParser;
use App\Services\Line\WebhookParsers\MessageParsers\TextParser;
use Exception;
use Tests\TestCase;

class ParserFactoryTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(TextParser::class, ParserFactory::make('text'));
        $this->assertInstanceOf(StickerParser::class, ParserFactory::make('sticker'));
    }

    public function testMakeWillThrowException()
    {
        try {
            ParserFactory::make('error-type');
        } catch (Exception $e) {
            $this->assertInstanceOf(UndefinedMessageTypeException::class, $e);
            $this->assertEquals('undefined message type [error-type]', $e->getMessage());
        }
    }
}
