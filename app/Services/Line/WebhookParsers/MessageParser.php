<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\Message;
use App\Contracts\Line\WebhookEvent;
use App\Contracts\Line\WebhookParser;
use App\Eloquents\Line\MessageEvent;
use App\Services\Line\WebhookParsers\MessageParsers\ParserFactory;

class MessageParser implements WebhookParser
{
    /**
     * @param array $event
     * @param bool $isAutoSave
     *
     * @return WebhookEvent
     */
    public function parse(array $event, bool $isAutoSave = false): WebhookEvent
    {
        $sourceType = array_get($event, 'source.type');
        $sourceId = array_get($event, "source.{$sourceType}Id");
        $messageEvent = new MessageEvent([
            'type' => array_get($event, 'type'),
            'message_type' => array_get($event, 'message.type'),
            'reply_token' => array_get($event, 'replyToken'),
            'timestamp' => intval(array_get($event, 'timestamp') / 1000),
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'origin_data' => $event,
        ]);

        $message = $this->parseMessage(array_get($event, 'message'));

        if ($isAutoSave) {
            return $this->saveEventWithMessage($messageEvent, $message);
        }

        $messageEvent->{$message->getReverseRelationName()} = $message;

        return $messageEvent;
    }

    /**
     * @param array $message
     *
     * @return Message
     */
    private function parseMessage(array $message): Message
    {
        $generator = ParserFactory::make(array_get($message, 'type'));

        return $generator->parse($message);
    }

    /**
     * @param MessageEvent $event
     * @param Message $message
     *
     * @return MessageEvent
     */
    private function saveEventWithMessage(MessageEvent $event, Message $message): MessageEvent
    {
        $relationName = $message->getReverseRelationName();
        $event->save();
        $event->{$relationName}()->save($message);

        return $event->load($relationName);
    }
}
