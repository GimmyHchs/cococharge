<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\LineAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LineAccountTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $events = factory(LineAccount::class, 5)->create();

        $this->assertEquals($events->count(), 5);
    }
}
