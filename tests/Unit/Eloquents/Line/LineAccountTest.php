<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\FollowEvent;
use App\Eloquents\Line\JoinEvent;
use App\Eloquents\Line\LeaveEvent;
use App\Eloquents\Line\LineAccount;
use App\Eloquents\Line\MessageEvent;
use App\Eloquents\Line\UnfollowEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LineAccountTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $accounts = factory(LineAccount::class, 5)->create();

        $this->assertEquals($accounts->count(), 5);
    }

    public function testHasManyFollowEvents()
    {
        $account = factory(LineAccount::class)->create();
        $event = factory(FollowEvent::class)->make();

        $account->followEvents()->save($event);

        $this->assertEquals($event->id, $account->followEvents->first()->id);
    }

    public function testHasManyUnfollowEvents()
    {
        $account = factory(LineAccount::class)->create();
        $event = factory(UnfollowEvent::class)->make();

        $account->unfollowEvents()->save($event);

        $this->assertEquals($event->id, $account->unfollowEvents->first()->id);
    }

    public function testHasManyJoinEvents()
    {
        $account = factory(LineAccount::class)->create();
        $event = factory(JoinEvent::class)->make();

        $account->joinEvents()->save($event);

        $this->assertEquals($event->id, $account->joinEvents->first()->id);
    }

    public function testHasManyLeaveEvents()
    {
        $account = factory(LineAccount::class)->create();
        $event = factory(LeaveEvent::class)->make();

        $account->leaveEvents()->save($event);

        $this->assertEquals($event->id, $account->leaveEvents->first()->id);
    }

    public function testHasManyMessageEvents()
    {
        $account = factory(LineAccount::class)->create();
        $event = factory(MessageEvent::class)->make();

        $account->messageEvents()->save($event);

        $this->assertEquals($event->id, $account->messageEvents->first()->id);
    }
}
