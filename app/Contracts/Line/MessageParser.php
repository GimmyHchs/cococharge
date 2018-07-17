<?php

namespace App\Contracts\Line;

interface MessageParser
{
    /**
     * @param array $message
     *
     * @return Message
     */
    public function parse(array $message): Message;
}
