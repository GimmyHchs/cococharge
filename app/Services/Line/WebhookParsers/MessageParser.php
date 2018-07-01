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
     * @param bool $isAutoSave
     *
     * @return IWebhookEvent
     */
    public function parse(array $event, bool $isAutoSave = false): IWebhookEvent
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

        $message = $this->generateMessage(array_get($event, 'message'));

        if ($isAutoSave) {
            return $this->saveEventWithMessage($messageEvent, $message);
        }

        $messageEvent->{$message->getReverseRelationName()} = $message;

        return $messageEvent;
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

    /**
     * @param MessageEvent $event
     * @param IMessage $message
     *
     * @return MessageEvent
     */
    private function saveEventWithMessage(MessageEvent $event, IMessage $message): MessageEvent
    {
        $relationName = $message->getReverseRelationName();
        $event->save();
        $event->{$relationName}()->save($message);

        return $event->load($relationName);
    }
}
