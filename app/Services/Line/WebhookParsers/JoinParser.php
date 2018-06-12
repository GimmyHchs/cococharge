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
     *
     * @return IWebhookEvent
     */
    public function parse(array $event, bool $is_auto_save = false): IWebhookEvent
    {
        $source_type = array_get($event, 'source.type');
        $source_id = array_get($event, "source.{$source_type}Id");
        $join_event = new JoinEvent([
            'type' => array_get($event, 'type'),
            'reply_token' => array_get($event, 'replyToken'),
            'timestamp' => intval(array_get($event, 'timestamp') / 1000),
            'source_type' => $source_type,
            'source_id' => $source_id,
            'origin_data' => $event,
        ]);

        if ($is_auto_save) {
            $join_event->save();
        }

        return $join_event;
    }
}
