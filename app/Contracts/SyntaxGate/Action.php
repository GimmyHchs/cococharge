<?php

namespace App\Contracts\SyntaxGate;

use App\Contracts\Line\WebhookEvent;

interface Action
{
    /**
     * @param WebhookEvent $event
     */
    public function execute(WebhookEvent $event): void;
}
