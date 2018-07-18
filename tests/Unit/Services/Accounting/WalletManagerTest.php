<?php

namespace Tests\Unit\Services\Accounting;

use App\Eloquents\Accounting\Expense;
use App\Eloquents\Accounting\Income;
use App\Eloquents\Accounting\Wallet;
use App\Services\Accounting\WalletManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletManagerTest extends TestCase
{
    use RefreshDatabase;

    public function testSetGetWallet()
    {
        $charger = app(WalletManager::class);
        $wallet = factory(Wallet::class)->create();
        $charger->setWallet($wallet);

        $this->assertEquals($wallet, $charger->getWallet());
    }

    public function testSpend()
    {
        $charger = app(WalletManager::class);
        $wallet = factory(Wallet::class)->create();
        $expense = factory(Expense::class)->create();
        $charger->setWallet($wallet);

        $charger->spend($expense);
        $this->assertEquals($expense->amount, $wallet->expenses->first()->amount);
    }

    public function testCharge()
    {
        $charger = app(WalletManager::class);
        $wallet = factory(Wallet::class)->create();
        $income = factory(Income::class)->create();
        $charger->setWallet($wallet);

        $charger->charge($income);
        $this->assertEquals($income->amount, $wallet->incomes->first()->amount);
    }
}
