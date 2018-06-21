<?php

namespace App\Contracts\Line;

interface IReplyableEvent
{
    /**
     * @return string
     */
    public function getReplyToken(): string;
}
