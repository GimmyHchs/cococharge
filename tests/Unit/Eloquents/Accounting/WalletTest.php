<?php

namespace Tests\Unit\Eloquents\Accounting;

use App\Eloquents\Accounting\Expense;
use App\Eloquents\Accounting\Income;
use App\Eloquents\Accounting\Wallet;
use App\Eloquents\Line\LineAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $wallets = factory(Wallet::class, 5)->create();

        $this->assertEquals($wallets->count(), 5);
    }

    public function testBelongsToLineAccount()
    {
        $wallet = factory(Wallet::class)->create();
        $lineAccount = factory(LineAccount::class)->create();
        $wallet->lineAccount()->associate($lineAccount)->save();

        $this->assertEquals($lineAccount->id, $wallet->lineAccount->id);
    }

    public function testHasManyIncomes()
    {
        $wallet = factory(Wallet::class)->create();
        $income = factory(Income::class)->make();
        $wallet->incomes()->save($income);

        $this->assertEquals($income->id, $wallet->incomes->first()->id);
    }

    public function testHasManyExpense()
    {
        $wallet = factory(Wallet::class)->create();
        $expense = factory(Expense::class)->make();
        $wallet->expenses()->save($expense);

        $this->assertEquals($expense->id, $wallet->expenses->first()->id);
    }
}
