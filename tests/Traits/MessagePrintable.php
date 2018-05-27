<?php

namespace Tests\Traits;

trait MessagePrintable
{
    public function printMessage($message)
    {
        return print  "\r\n[" . class_basename($this) . ']' . ' ' . $message . "\r\n";
    }

    public function printTestStartMessage($functionName)
    {
        return print  "\r\n[" . class_basename($this) . ']' . ' ' . $functionName . "...\r\n";
    }
}
