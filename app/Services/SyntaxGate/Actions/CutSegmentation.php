<?php

namespace App\Services\SyntaxGate\Actions;

use App\Contracts\Line\ReplyableEvent;
use App\Contracts\Line\WebhookEvent;
use App\Contracts\SyntaxGate\Action;
use App\Helpers\KeySignHelper;
use App\Services\Line\ReplyService;
use App\Services\Segmentation\JieBa;

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

        $segmentationList = $this->jieBa->possegCut(KeySignHelper::cutTriggerSign($messageContent));
        $this->sendSegmentationMessage($event, $segmentationList);
    }

    /**
     * @param ReplyableEvent $event
     */
    private function sendSegmentationMessage(ReplyableEvent $event, array $segmentationList): void
    {
        $segmentationList = array_map(function ($segmentation) {
            return implode($segmentation);
        }, $segmentationList);
        $this->replyService->setToken($event->getReplyToken());
        $message = implode($segmentationList, ', ');
        $this->replyService->sendText($message);
    }
}
