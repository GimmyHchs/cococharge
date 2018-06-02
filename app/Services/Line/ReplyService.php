<?php

namespace App\Services\Line;

use App\Line\Contracts\LineService;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

/**
 * 回覆Line訊息的服務.
 */
class ReplyService extends LineService
{
    /**
     * 回傳目標的token.
     *
     * @var string
     */
    protected $reply_token;

    public function setToken($reply_token)
    {
        $this->reply_token = $reply_token;
    }

    public function send($message = '你好，這是測試訊息，系統趕工中')
    {
        $httpClient = new CurlHTTPClient($this->channel_access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $this->channel_secret]);
        $messageBuilder = new TextMessageBuilder($message);
        $response = $bot->replyMessage($this->reply_token, $messageBuilder);

        return $response;
    }
}
