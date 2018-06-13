<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\MessageEvent;
use App\Eloquents\Line\Messages\LineSticker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LineStickerTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $stickers = factory(LineSticker::class, 5)->make();

        $this->assertEquals($stickers->count(), 5);
    }

    public function testBelongsToMessageEvent()
    {
        $sticker = factory(LineSticker::class)->make();
        $message_event = factory(MessageEvent::class)->create();

        $sticker->messageEvent()->associate($message_event)->save();

        $this->assertEquals($message_event->id, $sticker->messageEvent->id);
    }
}
