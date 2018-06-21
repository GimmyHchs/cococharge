<?php

namespace Tests\Unit\Services\Line;

use App\Eloquents\Line\JoinEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyableEventEloquentTest extends TestCase
{
    use RefreshDatabase;

    public function testGetType()
    {
        $join_event = factory(JoinEvent::class)->create();

        $this->assertEquals($join_event->reply_token, $join_event->getReplyToken());
    }
}
