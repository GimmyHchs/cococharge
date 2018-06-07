<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Services\Line\HookeventHandler;
use App\Services\Line\ReplyService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request, HookeventHandler $handler, ReplyService $reply_service)
    {
        $handler->handle($request->events, true);
        $reply_token = $handler->getFirstReplyToken();
        if ($reply_token) {
            $response = $reply_service->sendText('Hello!!');

            return response()->json(['message' => 'OK', 'line_response' => $response->getRawBody()]);
        }

        return response()->json(['message' => 'OK', 'line_response' => '']);
    }
}
