<?php

namespace App\Http\Clients\Line;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LINE\LINEBot\Constant\Meta;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\Response as LineResponse;

class LineClient implements HttpClient
{
    /**
     * @var Client
     */
    protected $guzzleClient;

    public function __construct($guzzleConfig = [])
    {
        $this->initGuzzle($guzzleConfig);
    }

    /**
     * Sends GET request to LINE Messaging API.
     *
     * @param string $url request URL
     *
     * @return LineResponse response of API request
     */
    public function get($url)
    {
        $response = $this->guzzleClient->get($url);

        return $this->generateLineResponse($response);
    }

    /**
     * Sends POST request to LINE Messaging API.
     *
     * @param string $url request URL
     * @param array $data request body
     *
     * @return LineResponse response of API request
     */
    public function post($url, array $data)
    {
        $response = $this->guzzleClient->post($url, ['json' => $data]);

        return $this->generateLineResponse($response);
    }

    /**
     * @param array $guzzleConfig
     */
    private function initGuzzle(array $guzzleConfig): void
    {
        $channelToken = config('line.channel_token');

        $config = array_merge([
            'http_errors' => false,
            'headers' => [
                'Authorization' => "Bearer $channelToken",
                'User-Agent' => 'LINE-BotSDK-PHP/' . Meta::VERSION,
            ],
        ], $guzzleConfig);

        $this->guzzleClient = new Client($config);
    }

    /**
     * @param GuzzleResponse $guzzleResponse
     *
     * @return LineResponse
     */
    private function generateLineResponse(GuzzleResponse $guzzleResponse): LineResponse
    {
        return new LineResponse($guzzleResponse->getStatusCode(), (string)$guzzleResponse->getBody());
    }
}
