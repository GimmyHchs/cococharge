<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\FollowEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowEventTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $events = factory(FollowEvent::class, 5)->create();

        $this->assertEquals($events->count(), 5);
    }

    public function testOriginDataCast()
    {
        $event = factory(FollowEvent::class)->create();

        $json_array = ['a' => 'test', 'b' => 1];

        $event->origin_data = $json_array;

        $this->assertEquals('test', $event->origin_data->a);
        $this->assertEquals(1, $event->origin_data->b);
    }

    public function testTimestampDate()
    {
        $event = factory(FollowEvent::class)->create();
        $event->timestamp = 1528383950;

        $this->assertInstanceOf(Carbon::class, $event->timestamp);
    }
}
