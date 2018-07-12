<?php

namespace Tests\Unit\Eloquents\Accounting;

use App\Eloquents\Accounting\Category;
use App\Eloquents\Accounting\Expense;
use App\Eloquents\Accounting\Income;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $categories = factory(Category::class, 5)->create();

        $this->assertEquals($categories->count(), 5);
    }

    public function testCategoryMorphedByManyIncomes()
    {
        $category = factory(Category::class)->create();
        $income = factory(Income::class)->create();

        $category->incomes()->save($income);

        $this->assertEquals($income->id, $category->incomes->first()->id);
    }

    public function testCategoryMorphedByManyExpenses()
    {
        $category = factory(Category::class)->create();
        $expense = factory(Expense::class)->create();

        $category->expenses()->save($expense);

        $this->assertEquals($expense->id, $category->expenses->first()->id);
    }
}
