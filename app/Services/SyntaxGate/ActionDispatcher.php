<?php

namespace App\Services\SyntaxGate;

use App\Contracts\Line\ReplyableEvent;
use App\Contracts\Line\WebhookEvent;
use App\Services\SyntaxGate\Actions\CutSegmentation;
use App\Services\SyntaxGate\Actions\InitialLineAccount;
use Illuminate\Support\Collection;

class ActionDispatcher
{
    /**
     * @var WebhookEvent
     */
    protected $event;

    /**
     * collection of App\Contracts\SyntaxGate\Action.
     *
     * @param Collection $actions
     */
    protected $actions;

    /**
     * @param WebhookEvent|null $event
     */
    public function setEvent(?WebhookEvent $event): void
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
        if ($this->event instanceof ReplyableEvent) {
            $this->actions[] = app(InitialLineAccount::class);
            $this->actions[] = app(CutSegmentation::class);
        }
    }
}
