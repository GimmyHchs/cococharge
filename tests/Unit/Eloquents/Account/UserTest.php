<?php

namespace Tests\Unit\Eloquents\Account;

use App\Eloquents\Account\LineUser;
use App\Eloquents\Account\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $users = factory(User::class, 5)->create();

        $this->assertEquals(5, User::all()->count());
    }

    public function testHasOneLineUser()
    {
        $user = factory(User::class)->create();
        $line_user = factory(LineUser::class)->create();

        $user->lineUser()->save($line_user);

        $this->assertEquals($user->id, $line_user->fresh()->user_id);
    }
}
