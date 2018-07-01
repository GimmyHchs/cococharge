<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\IWebhookEvent;
use App\Contracts\Line\IWebhookParser;
use App\Eloquents\Line\FollowEvent;

class FollowParser implements IWebhookParser
{
    /**
     * @param array $event
     * @param bool $isAutoSave
     *
     * @return IWebhookEvent
     */
    public function parse(array $event, bool $isAutoSave = false): IWebhookEvent
    {
        $sourceType = array_get($event, 'source.type');
        $sourceId = array_get($event, "source.{$sourceType}Id");
        $followEvent = new FollowEvent([
            'type' => array_get($event, 'type'),
            'reply_token' => array_get($event, 'replyToken'),
            'timestamp' => intval(array_get($event, 'timestamp') / 1000),
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'origin_data' => $event,
        ]);

        if ($isAutoSave) {
            $followEvent->save();
        }

        return $followEvent;
    }
}
