<?php

namespace Tests\Unit\Services\Line;

use App\Http\Clients\Line\LineClient;
use App\Services\Line\LineBot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LINE\LINEBot as BaseLineBot;
use LINE\LINEBot\Response;
use Tests\TestCase;

class LineBotTest extends TestCase
{
    use RefreshDatabase;

    public function testInit()
    {
        $bot = app(LineBot::class);

        $this->assertInstanceOf(BaseLineBot::class, $bot);
    }

    public function testReplySticker()
    {
        $mockToken = '2eb5fa7c59dc4e10a07bae00a5ca559e';
        $mockPackageId = '1';
        $mockStickerId = '1';
        $this->mock(LineClient::class)
            ->shouldReceive('post')
            ->with('https://api.line.me/v2/bot/message/reply', [
                'replyToken' => $mockToken,
                'messages' => [
                    [
                        'type' => 'sticker',
                        'packageId' => $mockPackageId,
                        'stickerId' => $mockStickerId,
                    ],
                ],
            ])
            ->once()
            ->andReturn(new Response(200, ''));

        $bot = app(LineBot::class);
        $response = $bot->replySticker($mockToken, $mockPackageId, $mockStickerId);

        $this->assertEquals(200, $response->getHTTPStatus());
    }
}
