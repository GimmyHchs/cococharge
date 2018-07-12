<?php

namespace Tests\Unit\Services\SyntaxGate;

use App\Contracts\Line\WebhookEvent;
use App\Eloquents\Line\MessageEvent;
use App\Services\SyntaxGate\ActionDispatcher;
use App\Services\SyntaxGate\Actions\InitialLineAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActionDispatcherTest extends TestCase
{
    use RefreshDatabase;

    public function testDispatchAction()
    {
        $event = factory(MessageEvent::class)->make();
        $this->bindToInterface(WebhookEvent::class, $event);

        $this->mock(InitialLineAccount::class)
            ->shouldReceive('execute')
            ->once()
            ->andReturnUsing(function ($arg) use ($event) {
                $this->assertEquals($arg, $event);
            });

        $dispatcher = app(ActionDispatcher::class);
        $dispatcher->setEvent($event);
        $dispatcher->dispatchActions();
    }
}
