<?php

use App\Eloquents\Accounting\Expense;
use App\Eloquents\Accounting\Income;
use App\Eloquents\Accounting\Wallet;
use App\Eloquents\Line\LineAccount;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(Wallet::class, function (Faker $faker) {
    $lineUser = factory(LineAccount::class)->create();

    return [
        'line_account_id' => $lineUser->id,
        'balance' => $faker->numberBetween(100000, 999999),
    ];
});

$factory->define(Income::class, function (Faker $faker) {
    $wallet = factory(Wallet::class)->create();

    return [
        'wallet_id' => $wallet->id,
        'amount' => $faker->numberBetween(100000, 999999),
    ];
});

$factory->define(Expense::class, function (Faker $faker) {
    $wallet = factory(Wallet::class)->create();

    return [
        'wallet_id' => $wallet->id,
        'amount' => $faker->numberBetween(100000, 999999),
    ];
});
