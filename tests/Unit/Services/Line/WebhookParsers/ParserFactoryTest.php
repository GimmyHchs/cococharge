<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Exceptions\Line\UndefinedEventTypeException;
use App\Services\Line\WebhookParsers\JoinParser;
use App\Services\Line\WebhookParsers\LeaveParser;
use App\Services\Line\WebhookParsers\ParserFactory;
use Exception;
use Tests\TestCase;

class ParserFactoryTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(JoinParser::class, ParserFactory::make('join'));
        $this->assertInstanceOf(LeaveParser::class, ParserFactory::make('leave'));
    }

    public function testMakeWillThrowException()
    {
        try {
            ParserFactory::make('error-type');
        } catch (Exception $e) {
            $this->assertInstanceOf(UndefinedEventTypeException::class, $e);
            $this->assertEquals('undefined webhook type [error-type]', $e->getMessage());
        }
    }
}
