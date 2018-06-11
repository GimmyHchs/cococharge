<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Exceptions\Line\UndefinedEventTypeException;
use App\Services\Line\WebhookParsers\FollowParser;
use App\Services\Line\WebhookParsers\JoinParser;
use App\Services\Line\WebhookParsers\LeaveParser;
use App\Services\Line\WebhookParsers\MessageParser;
use App\Services\Line\WebhookParsers\ParserFactory;
use App\Services\Line\WebhookParsers\UnfollowParser;
use Exception;
use Tests\TestCase;

class ParserFactoryTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(JoinParser::class, ParserFactory::make('join'));
        $this->assertInstanceOf(LeaveParser::class, ParserFactory::make('leave'));
        $this->assertInstanceOf(FollowParser::class, ParserFactory::make('follow'));
        $this->assertInstanceOf(UnfollowParser::class, ParserFactory::make('unfollow'));
        $this->assertInstanceOf(MessageParser::class, ParserFactory::make('message'));
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
