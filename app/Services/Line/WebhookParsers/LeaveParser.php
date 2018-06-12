<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\IWebhookEvent;
use App\Contracts\Line\IWebhookParser;
use App\Eloquents\Line\LeaveEvent;

class LeaveParser implements IWebhookParser
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
        $leave_event = new LeaveEvent([
            'type' => array_get($event, 'type'),
            'timestamp' => intval(array_get($event, 'timestamp') / 1000),
            'source_type' => $source_type,
            'source_id' => $source_id,
            'origin_data' => $event,
        ]);

        if ($is_auto_save) {
            $leave_event->save();
        }

        return $leave_event;
    }
}
