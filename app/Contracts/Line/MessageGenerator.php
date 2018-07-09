<?php

namespace App\Contracts\Line;

interface MessageGenerator
{
    /**
     * @param array $message
     *
     * @return Message
     */
    public function generate(array $message): Message;
}
