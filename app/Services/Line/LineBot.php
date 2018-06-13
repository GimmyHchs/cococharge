<?php

namespace App\Services\Line;

use App\Http\Clients\Line\LineClient;
use LINE\LINEBot as BaseLineBot;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\Response;

class LineBot extends BaseLineBot
{
    /**
     * @var LineClient
     */
    protected $client;

    /**
     * LINEBot constructor.
     *
     * @param HTTPClient $httpClient HTTP client instance to use API calling
     * @param array $args configurations
     */
    public function __construct()
    {
        $client = app(LineClient::class);
        $this->client = $client;
        $secret = config('line.channel_secret');
        parent::__construct($client, ['channelSecret' => $secret]);
    }

    /**
     * @param string $reply_token
     * @param string $package_id
     * @param string $sticker_id
     *
     * @return Response
     */
    public function replySticker(string $reply_token, string $package_id, string $sticker_id): Response
    {
        $stickerBuilder = app(StickerMessageBuilder::class, [
            'packageId' => $package_id,
            'stickerId' => $sticker_id,
        ]);

        return $this->client->post(self::DEFAULT_ENDPOINT_BASE . '/v2/bot/message/reply', [
            'replyToken' => $reply_token,
            'messages' => $stickerBuilder->buildMessage(),
        ]);
    }
}
