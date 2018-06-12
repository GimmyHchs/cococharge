<?php

namespace App\Traits\Line;

use stdClass;

trait WebhookEventEloquent
{
    public function getType(): string
    {
        return $this->type;
    }

    public function getOriginData(): stdClass
    {
        return $this->origin_data;
    }
}
