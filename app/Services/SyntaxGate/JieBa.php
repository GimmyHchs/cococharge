<?php

namespace App\Services\SyntaxGate;

use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba as BaseJieba;

class JieBa
{
    public function __construct(array $config = [])
    {
        ini_set('memory_limit', '768M');
        BaseJieba::init(['dict' => 'small']);
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
