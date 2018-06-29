<?php

namespace App\Services\SyntaxGate\Actions;

use App\Contracts\Line\IReplyableEvent;
use App\Contracts\Line\IWebhookEvent;
use App\Contracts\SyntaxGate\IAction;
use App\Eloquents\Line\LineAccount;
use App\Services\Line\ReplyService;

class InitialLineAccount implements IAction
{
    /**
     * @var ReplyService
     */
    protected $reply_service;

    public function __construct(ReplyService $service)
    {
        $this->reply_service = $service;
    }

    /**
     * @param IWebhookEvent $event
     */
    public function execute(IWebhookEvent $event): void
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
     * @param IReplyableEvent $event
     */
    private function sendAccountCreatedMessage(IReplyableEvent $event): void
    {
        $this->reply_service->setToken($event->getReplyToken());
        $this->reply_service->sendText(trans(
            'initial_line_account.account_created_notification',
            ['bot_name' => config('bot.name')]
        ));
    }
}
