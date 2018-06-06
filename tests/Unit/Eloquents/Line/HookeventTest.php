<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\Hookevent;
use App\Eloquents\Line\LineText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HookEventTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $events = factory(Hookevent::class, 5)->create();

        $this->assertEquals($events->count(), 5);
    }

    public function testHasManyLineText()
    {
        $event = factory(Hookevent::class)->create();
        $line_texts = factory(LineText::class, 3)->make();

        $event->lineTexts()->saveMany($line_texts);

        $this->assertEquals(3, $event->lineTexts->count());
    }

    public function testAddLineText()
    {
        $event = factory(Hookevent::class)->create();
        $line_text = factory(LineText::class)->make();

        $event->addLineText($line_text);
        $this->assertEquals($event->id, $line_text->fresh()->hookevent_id);
    }

    public function testMessageCast()
    {
        $event = factory(Hookevent::class)->create();

        $json_array = ['a' => 'test', 'b' => 1];

        $event->message = $json_array;

        $this->assertEquals('test', $event->message->a);
        $this->assertEquals(1, $event->message->b);
    }

    public function testOriginalDataCast()
    {
        $event = factory(Hookevent::class)->create();

        $json_array = ['a' => 'test', 'b' => 1];

        $event->original_data = $json_array;

        $this->assertEquals('test', $event->original_data->a);
        $this->assertEquals(1, $event->original_data->b);
    }

    public function testSourceAccessorAndMutator()
    {
        $event = factory(Hookevent::class)->create();

        $json_array = ['a' => 'test', 'b' => 1];

        $event->source = $json_array;

        $this->assertEquals('test', $event->source->a);
        $this->assertEquals(1, $event->source->b);
    }
}
