<?php

namespace Tests\Unit\Services\Line\WebhookParsers;

use App\Services\Line\WebhookParsers\JoinParser;
use App\Services\Line\WebhookParsers\ParserFactory;
use Tests\TestCase;

class ParserFactoryTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(JoinParser::class, ParserFactory::make('join'));
    }
}
