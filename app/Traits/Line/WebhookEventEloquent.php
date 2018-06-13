<?php

namespace App\Traits\Line;

use stdClass;

trait WebhookEventEloquent
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return stdClass
     */
    public function getOriginData(): stdClass
    {
        return $this->origin_data;
    }
}
