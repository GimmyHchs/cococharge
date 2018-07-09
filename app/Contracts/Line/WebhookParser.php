<?php

namespace App\Contracts\Line;

interface WebhookParser
{
    /**
     * @param array $event
     * @param bool $isAutoSave
     *
     * @return WebhookEvent
     */
    public function parse(array $event, bool $isAutoSave = false): WebhookEvent;
}
