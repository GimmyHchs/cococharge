<?php

namespace App\Services\SyntaxGate\Actions;

use App\Contracts\Line\ReplyableEvent;
use App\Contracts\Line\WebhookEvent;
use App\Contracts\SyntaxGate\Action;
use App\Eloquents\Line\LineAccount;
use App\Services\Line\ReplyService;

class InitialLineAccount implements Action
{
    /**
     * @var ReplyService
     */
    protected $replyService;

    public function __construct(ReplyService $service)
    {
        $this->replyService = $service;
    }

    /**
     * @param WebhookEvent $event
     */
    public function execute(WebhookEvent $event): void
    {
        $line_account = LineAccount::firstOrNew([
            'line_id' => $event->getSourceId(),
            'type' => $event->getSourceType(),
        ]);

        if ($line_account->exists) {
            return;
        }

        $line_account->save();
        $this->sendAccountCreatedMessage($event);
    }

    /**
     * @param ReplyableEvent $event
     */
    private function sendAccountCreatedMessage(ReplyableEvent $event): void
    {
        $this->replyService->setToken($event->getReplyToken());
        $this->replyService->sendText(trans(
            'initial_line_account.account_created_notification',
            ['bot_name' => config('bot.name')]
        ));
    }
}
