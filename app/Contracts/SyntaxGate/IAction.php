<?php

namespace App\Contracts\SyntaxGate;

use App\Contracts\Line\IWebhookEvent;

interface IAction
{
    /**
     * @param IWebhookEvent $event
     */
    public function execute(IWebhookEvent $event): void;
}
