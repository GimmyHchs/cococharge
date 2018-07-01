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
        $messageEvent = factory(MessageEvent::class)->create();

        $sticker->messageEvent()->associate($messageEvent)->save();

        $this->assertEquals($messageEvent->id, $sticker->messageEvent->id);
    }
}
