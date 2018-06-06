<?php

namespace Tests\Unit\Services\Line;

use App\Services\Line\LineBot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LINE\LINEBot as BaseLineBot;
use Tests\TestCase;

class LineBotTest extends TestCase
{
    use RefreshDatabase;

    public function testInit()
    {
        $bot = app(LineBot::class);

        $this->assertInstanceOf(BaseLineBot::class, $bot);
    }
}
