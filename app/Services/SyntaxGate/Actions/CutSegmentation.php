<?php

namespace App\Services\SyntaxGate\Actions;

use App\Contracts\Line\ReplyableEvent;
use App\Contracts\Line\WebhookEvent;
use App\Contracts\SyntaxGate\Action;
use App\Services\SyntaxGate\JieBa;
use App\Helpers\KeySignHelper;
use App\Services\Line\ReplyService;

class CutSegmentation implements Action
{
    /**
     * @var ReplyService
     */
    protected $replyService;

    /**
     * @var JieBa
     */
    protected $jieBa;

    public function __construct(ReplyService $service, JieBa $jieBa)
    {
        $this->replyService = $service;
        $this->jieBa = $jieBa;
    }

    /**
     * @param WebhookEvent $event
     */
    public function execute(WebhookEvent $event): void
    {
        $messageContent = optional($event->lineText)->text;
        if (!KeySignHelper::hasTriggerSign($messageContent)) {
            return;
        }

        $segmentationList = $this->jieBa->cut(KeySignHelper::cutTriggerSign($messageContent));
        $this->sendSegmentationMessage($event, $segmentationList);
    }

    /**
     * @param ReplyableEvent $event
     */
    private function sendSegmentationMessage(ReplyableEvent $event, array $segmentationList): void
    {
        $this->replyService->setToken($event->getReplyToken());
        $message = implode($segmentationList, ', ');
        $this->replyService->sendText($message);
    }
}
