<?php

namespace Tests\Unit\Services\SyntaxGate\Actions;

use App\Eloquents\Line\LineAccount;
use App\Eloquents\Line\Messages\LineText;
use App\Services\SyntaxGate\Actions\InitialLineAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InitialLineAccountTest extends TestCase
{
    use RefreshDatabase;

    public function testExecute()
    {
        $text = factory(LineText::class)->states('withMessageEvent')->create();
        $event = $text->messageEvent;
        $action = app(InitialLineAccount::class);
        $action->execute($event);

        $this->assertEquals(1, LineAccount::all()->count());
        $this->assertEquals($event->source_type, LineAccount::first()->type);
        $this->assertEquals($event->source_id, LineAccount::first()->line_id);
    }
}
