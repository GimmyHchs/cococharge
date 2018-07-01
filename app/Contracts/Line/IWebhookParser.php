<?php

namespace App\Contracts\Line;

interface IWebhookParser
{
    /**
     * @param array $event
     * @param bool $isAutoSave
     *
     * @return IWebhookEvent
     */
    public function parse(array $event, bool $isAutoSave = false): IWebhookEvent;
}
