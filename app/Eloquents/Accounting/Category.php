<?php

namespace App\Eloquents\Accounting;

use App\Eloquents\Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Eloquent
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'display_name',
    ];

    /**
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * @return HasMany
     */
    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }
}
