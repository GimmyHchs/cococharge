<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\IWebhookParser;
use App\Exceptions\Line\UndefinedEventTypeException;

class ParserFactory
{
    /**
     * @param string $type
     *
     * @return IWebhookParser
     */
    public static function make(string $type): IWebhookParser
    {
        switch ($type) {
            case 'join':
                return app(JoinParser::class);
            case 'leave':
                return app(LeaveParser::class);
            case 'follow':
                return app(FollowParser::class);
            case 'unfollow':
                return app(UnfollowParser::class);
            case 'message':
                return app(MessageParser::class);
            default:
                throw new UndefinedEventTypeException("undefined webhook type [{$type}]");
        }
    }
}
