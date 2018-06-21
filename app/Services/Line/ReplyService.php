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

    /**
     * @param string $package_id
     * @param string $sticker_id
     *
     * @return Response
     */
    public function sendSticker(string $package_id, string $sticker_id): Response
    {
        return $this->bot->replySticker($this->reply_token, $package_id, $sticker_id);
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
