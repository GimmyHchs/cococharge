<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\IMessage;
use App\Contracts\Line\IWebhookEvent;
use App\Contracts\Line\IWebhookParser;
use App\Eloquents\Line\MessageEvent;
use App\Services\Line\WebhookParsers\MessageGenerators\GeneratorFactory;

class MessageParser implements IWebhookParser
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
        $join_event = new MessageEvent([
            'type' => array_get($event, 'type'),
            'reply_token' => array_get($event, 'replyToken'),
            'timestamp' => intval(array_get($event, 'timestamp') / 1000),
            'source_type' => $source_type,
            'source_id' => $source_id,
            'origin_data' => $event,
        ]);

        $message = $this->generateMessage(array_get($event, 'message'));
        $message_relation = $message->getReverseRelationName();

        if ($is_auto_save) {
            $join_event->save();
            $join_event->{$message_relation}()->save($message);

            return $join_event->load($message_relation);
        }

        $join_event->{$message_relation} = $message;

        return $join_event;
    }

    /**
     * @param array $message
     *
     * @return IMessage
     */
    private function generateMessage(array $message): IMessage
    {
        $generator = GeneratorFactory::make(array_get($message, 'type'));

        return $generator->generate($message);
    }
}
