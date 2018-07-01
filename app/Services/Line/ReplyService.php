<?php

namespace App\Services\Line;

use App\Contracts\Line\IReplyableEvent;
use Illuminate\Support\Collection;
use LINE\LINEBot\Response;

/**
 * 回覆Line訊息的服務.
 */
class ReplyService
{
    /**
     * @var string
     */
    protected $replyToken;

    /**
     * @var LineBot
     */
    protected $bot;

    public function __construct(LineBot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @param string $replyToken
     */
    public function setToken(string $replyToken): void
    {
        $this->replyToken = $replyToken;
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function sendText(string $message): Response
    {
        return $this->bot->replyText($this->replyToken, $message);
    }

    /**
     * @param string $packageId
     * @param string $stickerId
     *
     * @return Response
     */
    public function sendSticker(string $packageId, string $stickerId): Response
    {
        return $this->bot->replySticker($this->replyToken, $packageId, $stickerId);
    }

    /**
     * return the count of replied.
     *
     * @param Collection $events
     *
     * @return int
     */
    public function replyByEvents(Collection $events): int
    {
        $count = 0;

        foreach ($events as $event) {
            if (!$event instanceof IReplyableEvent || $event->getType() != 'message') {
                continue;
            }
            $this->setToken($event->getReplyToken());
            ($event->message_type == 'sticker')
                ? $this->sendSticker('2', '501')
                : $this->sendText('Hello!!');
            $count++;
        }

        return $count;
    }
}
