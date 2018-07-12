<?php

namespace Tests\Unit\Eloquents\Accounting;

use App\Eloquents\Accounting\Category;
use App\Eloquents\Accounting\Income;
use App\Eloquents\Accounting\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncomeTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $incomes = factory(Income::class, 5)->create();

        $this->assertEquals($incomes->count(), 5);
    }

    public function testBelongsToWallet()
    {
        $income = factory(Income::class)->create();
        $wallet = factory(Wallet::class)->create();
        $income->wallet()->associate($wallet)->save();

        $this->assertEquals($wallet->id, $income->wallet->id);
    }

    public function testBelongsToCategory()
    {
        $income = factory(Income::class)->create();
        $category = factory(Category::class)->create();

        $income->category()->associate($category)->save();

        $this->assertEquals($category->id, $income->category->id);
    }

    public function testGetCategoryType()
    {
        $income = factory(Income::class)->create();

        $this->assertEquals(Income::CATEGORY_TYPE, $income->getCategoryType());
    }
}
