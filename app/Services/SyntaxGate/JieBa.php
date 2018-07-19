<?php

namespace App\Services\SyntaxGate;

use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba as BaseJieba;

class JieBa
{
    public function __construct(array $config = [])
    {
        BaseJieba::init(['dict' => 'big']);
        Finalseg::init();
    }

    /**
     * @return array
     */
    public function cut(string $text): array
    {
        return BaseJieba::cut($text);
    }
}
