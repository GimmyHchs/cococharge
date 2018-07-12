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

    public function testSourceId()
    {
        $join_event = factory(JoinEvent::class)->create();
        $join_event->source_id = 'mock-source-id';

        $this->assertEquals('mock-source-id', $join_event->getSourceId());
    }

    public function testSourceType()
    {
        $join_event = factory(JoinEvent::class)->create();
        $join_event->source_type = 'mock-source-type';

        $this->assertEquals('mock-source-type', $join_event->getSourceType());
    }
}
