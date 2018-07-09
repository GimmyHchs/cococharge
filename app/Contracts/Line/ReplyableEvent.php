<?php

namespace App\Contracts\Line;

interface ReplyableEvent
{
    /**
     * @return string
     */
    public function getReplyToken(): string;
}
