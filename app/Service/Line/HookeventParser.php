<?php

namespace App\Service\Line;

use App\Eloquents\Line\Hookevent;
use Illuminate\Support\Collection;

class HookeventParser
{
    /**
     * @param array $events
     *
     * @return Collection
     */
    public static function parse(array $events): Collection
    {
        $messages = [];

        foreach ($events as $event) {
            array_push($messages, new Hookevent([
                'original_data' => $event,
                'reply_token' => $event['replyToken'],
                'type' => $event['type'],
                'timestamp' => $event['timestamp'],
                'source' => $event['source'],
                'message' => $event['message'] ?? null,
            ]));
        }

        return collect($messages);
    }
}
