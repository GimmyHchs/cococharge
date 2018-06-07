<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\JoinEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JoinEventTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $events = factory(JoinEvent::class, 5)->create();

        $this->assertEquals($events->count(), 5);
    }

    public function testOriginDataCast()
    {
        $event = factory(JoinEvent::class)->create();

        $json_array = ['a' => 'test', 'b' => 1];

        $event->origin_data = $json_array;

        $this->assertEquals('test', $event->origin_data->a);
        $this->assertEquals(1, $event->origin_data->b);
    }
}
