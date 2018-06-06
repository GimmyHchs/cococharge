<?php

namespace App\Services\Line;

use App\Http\Clients\Line\LineClient;
use LINE\LINEBot as BaseLineBot;

class LineBot extends BaseLineBot
{
    /**
     * LINEBot constructor.
     *
     * @param HTTPClient $httpClient HTTP client instance to use API calling
     * @param array $args configurations
     */
    public function __construct()
    {
        $client = app(LineClient::class);
        $secret = config('line.channel_secret');
        parent::__construct($client, ['channelSecret' => $secret]);
    }
}
