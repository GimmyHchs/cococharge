<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Services\Line\HookeventParser;
use App\Services\Line\ReplyService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request, HookeventParser $parser, ReplyService $reply_service)
    {
        $parser->parse($request->events, true);

        $reply_service->setToken($parser->getFirstReplyToken());
        $response = $reply_service->sendText('Hello!!');

        return response()->json(['message' => 'OK', 'line_response' => $response->getRawBody()]);
    }
}
