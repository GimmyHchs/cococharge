<?php

namespace App\Contracts\Line;

use stdClass;

interface IWebhookEvent
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return stdClass
     */
    public function getOriginData(): stdClass;
}
