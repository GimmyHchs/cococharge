<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Services\Line\HookeventHandler;
use App\Services\SyntaxGate\ActionDispatcher;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request, HookeventHandler $handler, ActionDispatcher $dispatcher)
    {
        $events = $handler->handle($request->events, true);

        $dispatcher->setEvent($events->first());
        $dispatcher->dispatchActions();

        return response()->json(['message' => 'OK', 'line_response' => '']);
    }
}
