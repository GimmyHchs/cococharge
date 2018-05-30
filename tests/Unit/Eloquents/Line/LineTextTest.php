<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\Hookevent;
use App\Eloquents\Line\LineText;
use App\Eloquents\Line\LineUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LineTextTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $text = factory(LineText::class, 5)->create();

        $this->assertEquals($text->count(), 5);
    }

    public function testBelongsToLineUser()
    {
        $line_user = factory(LineUser::class)->create();
        $line_text = factory(LineText::class)->create();

        $line_text->lineUser()->associate($line_user);

        $this->assertEquals($line_user->id, $line_text->line_user_id);
    }

    public function testBelongsToHookevent()
    {
        $hookevent = factory(Hookevent::class)->create();
        $line_text = factory(LineText::class)->create();

        $line_text->hookevent()->associate($hookevent);

        $this->assertEquals($hookevent->id, $line_text->hookevent_id);
    }
}
