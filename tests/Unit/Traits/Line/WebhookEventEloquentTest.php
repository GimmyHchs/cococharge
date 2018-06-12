<?php

namespace Tests\Unit\Services\Line;

use App\Eloquents\Line\JoinEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebhookEventEloquentTest extends TestCase
{
    use RefreshDatabase;

    public function testGetType()
    {
        $join_event = factory(JoinEvent::class)->create();
        $join_event->type = 'mock-type';

        $this->assertEquals('mock-type', $join_event->getType());
    }

    public function testGetOriginData()
    {
        $join_event = factory(JoinEvent::class)->create();
        $join_event->origin_data = ['attribute' => 'mock-value'];

        $this->assertEquals('mock-value', $join_event->getOriginData()->attribute);
    }
}
