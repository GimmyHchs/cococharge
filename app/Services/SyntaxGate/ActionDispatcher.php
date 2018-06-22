<?php

namespace App\Services\SyntaxGate;

use App\Contracts\Line\IReplyableEvent;
use App\Contracts\Line\IWebhookEvent;
use App\Services\SyntaxGate\Actions\InitialLineAccount;
use Illuminate\Support\Collection;

class ActionDispatcher
{
    /**
     * @var IWebhookEvent
     */
    protected $event;

    /**
     * collection of \App\Services\SyntaxGate\Actions\Action.
     *
     * @param Collection $actions
     */
    protected $actions;

    /**
     * @param IWebhookEvent|null $event
     */
    public function setEvent(?IWebhookEvent $event): void
    {
        $this->event = $event;
        $this->filterActions();
    }

    public function dispatchActions(): void
    {
        foreach ($this->actions as $action) {
            $action->execute($this->event);
        }
    }

    private function filterActions()
    {
        if ($this->event instanceof IReplyableEvent) {
            $this->actions[] = app(InitialLineAccount::class);
        }
    }
}
