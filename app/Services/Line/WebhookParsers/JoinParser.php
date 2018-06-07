<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\IWebhookEvent;
use App\Contracts\Line\IWebhookParser;
use App\Eloquents\Line\JoinEvent;

class JoinParser implements IWebhookParser
{
    /**
     * @param array $event
     * @param bool $is_auto_save
     */
    public function parse(array $event, bool $is_auto_save = false): IWebhookEvent
    {
        $event_join = new JoinEvent([
            'type' => array_get($event, 'type'),
            'reply_token' => array_get($event, 'replyToken'),
            'timestamp' => array_get($event, 'timestamp'),
            'source_type' => array_first(array_values($event['source'])),
            'source_id' => array_last(array_values($event['source'])),
        ]);

        if ($is_auto_save) {
            $event_join->save();
        }

        return $event_join;
    }
}
