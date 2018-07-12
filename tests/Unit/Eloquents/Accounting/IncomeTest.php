<?php

namespace Tests\Unit\Eloquents\Accounting;

use App\Eloquents\Accounting\Income;
use App\Eloquents\Accounting\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncomeTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $wallets = factory(Income::class, 5)->create();

        $this->assertEquals($wallets->count(), 5);
    }

    public function testBelongsToWallet()
    {
        $income = factory(Income::class)->create();
        $wallet = factory(Wallet::class)->create();
        $income->wallet()->associate($wallet)->save();

        $this->assertEquals($wallet->id, $income->wallet->id);
    }
}
