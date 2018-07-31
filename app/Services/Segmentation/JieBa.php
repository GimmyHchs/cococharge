<?php

namespace App\Services\Segmentation;

use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba as BaseJieba;
use Fukuball\Jieba\Posseg;

class JieBa
{
    public function __construct(array $config = [])
    {
        ini_set('memory_limit', '768M');
        BaseJieba::init(['dict' => 'small']);
        Finalseg::init();
        Posseg::init();
    }

    /**
     * @return array
     */
    public function cut(string $text): array
    {
        return BaseJieba::cut($text);
    }

    /**
     * @param string $text
     *
     * @return array
     */
    public function possegCut(string $text): array
    {
        return Posseg::cut($text);
    }
}
