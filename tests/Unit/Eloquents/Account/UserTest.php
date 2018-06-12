<?php

namespace Tests\Unit\Eloquents\Account;

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
}
