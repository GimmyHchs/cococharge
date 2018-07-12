<?php

namespace Tests\Unit\Eloquents\Accounting;

use App\Eloquents\Accounting\Expense;
use App\Eloquents\Accounting\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $wallets = factory(Expense::class, 5)->create();

        $this->assertEquals($wallets->count(), 5);
    }

    public function testBelongsToWallet()
    {
        $expense = factory(Expense::class)->create();
        $wallet = factory(Wallet::class)->create();
        $expense->wallet()->associate($wallet)->save();

        $this->assertEquals($wallet->id, $expense->wallet->id);
    }
}
