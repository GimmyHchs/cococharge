<?php

namespace Tests\Unit\Eloquents\Accounting;

use App\Eloquents\Accounting\Category;
use App\Eloquents\Accounting\Expense;
use App\Eloquents\Accounting\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $expenses = factory(Expense::class, 5)->create();

        $this->assertEquals($expenses->count(), 5);
    }

    public function testBelongsToWallet()
    {
        $expense = factory(Expense::class)->create();
        $wallet = factory(Wallet::class)->create();
        $expense->wallet()->associate($wallet)->save();

        $this->assertEquals($wallet->id, $expense->wallet->id);
    }

    public function testBelongsToCategory()
    {
        $expense = factory(Expense::class)->create();
        $category = factory(Category::class)->create();

        $expense->category()->associate($category)->save();

        $this->assertEquals($category->id, $expense->category->id);
    }

    public function testGetCategoryType()
    {
        $expense = factory(Expense::class)->create();

        $this->assertEquals(Expense::CATEGORY_TYPE, $expense->getCategoryType());
    }
}
