<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\JoinEvent;
use App\Eloquents\Line\LineAccount;
use Carbon\Carbon;
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

    public function testTimestampDate()
    {
        $event = factory(JoinEvent::class)->create();
        $event->timestamp = 1528383950;

        $this->assertInstanceOf(Carbon::class, $event->timestamp);
    }

    public function testBelongsToLineAccount()
    {
        $event = factory(JoinEvent::class)->create();
        $account = factory(LineAccount::class)->create();

        $event->lineAccount()->associate($account)->save();

        $this->assertEquals($account->id, $event->lineAccount->id);
    }
}
