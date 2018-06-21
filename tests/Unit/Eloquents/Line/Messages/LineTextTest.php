<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\MessageEvent;
use App\Eloquents\Line\Messages\LineText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LineTextTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $texts = factory(LineText::class, 5)->make();

        $this->assertEquals($texts->count(), 5);
    }

    public function testBelongsToMessageEvent()
    {
        $text = factory(LineText::class)->make();
        $message_event = factory(MessageEvent::class)->create();

        $text->messageEvent()->associate($message_event)->save();

        $this->assertEquals($message_event->id, $text->messageEvent->id);
    }
}
