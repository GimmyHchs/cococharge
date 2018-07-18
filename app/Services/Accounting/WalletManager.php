<?php

namespace App\Services\Accounting;

use App\Eloquents\Accounting\Expense;
use App\Eloquents\Accounting\Income;
use App\Eloquents\Accounting\Wallet;

class WalletManager
{
    /**
     * @var Wallet
     */
    protected $wallet;

    /**
     * @param Wallet $wallet
     */
    public function setWallet(Wallet $wallet): void
    {
        $this->wallet = $wallet;
    }

    /**
     * @return Wallet|null
     */
    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    /**
     * @param Expense $expense
     */
    public function spend(Expense $expense): void
    {
        $this->wallet->expenses()->save($expense);
    }

    /**
     * @param Income $income
     */
    public function charge(Income $income): void
    {
        $this->wallet->incomes()->save($income);
    }
}
