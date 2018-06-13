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
        $events = $handler->handle($request->events, true);

        $response = $reply_service->replyByEvents($events);

        return response()->json(['message' => 'OK', 'line_response' => '']);
    }
}
