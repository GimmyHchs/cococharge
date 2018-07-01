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
     * @param string $replyToken
     * @param string $packageId
     * @param string $stickerId
     *
     * @return Response
     */
    public function replySticker(string $replyToken, string $packageId, string $stickerId): Response
    {
        $stickerBuilder = app(StickerMessageBuilder::class, [
            'packageId' => $packageId,
            'stickerId' => $stickerId,
        ]);

        return $this->client->post(self::DEFAULT_ENDPOINT_BASE . '/v2/bot/message/reply', [
            'replyToken' => $replyToken,
            'messages' => $stickerBuilder->buildMessage(),
        ]);
    }
}
