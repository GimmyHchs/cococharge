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
        $messageEvent = factory(MessageEvent::class)->create();

        $text->messageEvent()->associate($messageEvent)->save();

        $this->assertEquals($messageEvent->id, $text->messageEvent->id);
    }
}
