<?php

namespace App\Services\Line;

use LINE\LINEBot\Response;

/**
 * 回覆Line訊息的服務.
 */
class ReplyService
{
    /**
     * @var string
     */
    protected $reply_token;

    /**
     * @var LineBot
     */
    protected $bot;

    public function __construct(LineBot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @param string $reply_token
     */
    public function setToken(string $reply_token): void
    {
        $this->reply_token = $reply_token;
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function sendText(string $message): Response
    {
        return $this->bot->replyText($this->reply_token, $message);
    }
}
