<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\MessageEvent;
use App\Eloquents\Line\Messages\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TextTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $texts = factory(Text::class, 5)->create();

        $this->assertEquals($texts->count(), 5);
    }

    public function testBelongsToMessageEvent()
    {
        $text = factory(Text::class)->create();
        $message_event = factory(MessageEvent::class)->create();

        $text->messageEvent()->associate($message_event)->save();

        $this->assertEquals($message_event->id, $text->messageEvent->id);
    }
}
