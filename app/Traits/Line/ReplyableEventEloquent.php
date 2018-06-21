<?php

namespace App\Traits\Line;

trait ReplyableEventEloquent
{
    /**
     * @return string
     */
    public function getReplyToken(): string
    {
        return $this->reply_token;
    }
}
