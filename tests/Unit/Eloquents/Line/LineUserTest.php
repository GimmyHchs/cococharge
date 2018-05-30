<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Account\User;
use App\Eloquents\Line\LineUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LineUserTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $users = factory(LineUser::class, 5)->create();

        $this->assertEquals($users->count(), 5);
    }

    public function testAssignToUser()
    {
        $user = factory(User::class)->create();
        $line_user = factory(LineUser::class)->create();
        $line_user->assignToUser($user);

        $this->assertEquals($line_user->id, $user->lineUser->id);
    }
}
