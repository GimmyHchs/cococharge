<?php

namespace App\Contracts\Line;

interface IWebhookParser
{
    /**
     * @param array $event
     * @param bool $is_auto_save
     *
     * @return IWebhookEvent
     */
    public function parse(array $event, bool $is_auto_save = false): IWebhookEvent;
}
