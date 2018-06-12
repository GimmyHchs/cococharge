<?php

namespace App\Contracts\Line;

interface IMessageGenerator
{
    /**
     * @param array $message
     *
     * @return IMessage
     */
    public function generate(array $message): IMessage;
}
