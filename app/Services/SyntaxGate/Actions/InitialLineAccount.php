<?php

namespace App\Services\SyntaxGate\Actions;

use App\Contracts\Line\IWebhookEvent;
use App\Contracts\SyntaxGate\IAction;
use App\Eloquents\Line\LineAccount;

class InitialLineAccount implements IAction
{
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
    }
}
