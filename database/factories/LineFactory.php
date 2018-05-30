<?php

use App\Eloquents\Line\Hookevent;
use App\Eloquents\Line\LineText;
use App\Eloquents\Line\LineUser;
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

$factory->define(LineUser::class, function (Faker $faker) {
    return [
        'line_id' => str_random(20),
    ];
});

$factory->define(Hookevent::class, function (Faker $faker) {
    return [
        'original_data' => str_random(20),
        'reply_token' => str_random(20),
        'type' => $faker->word,
        'timestamp' => str_random(20),
        'source' => $faker->word,
        'message' => $faker->word,
    ];
});

$factory->define(LineText::class, function (Faker $faker) {
    return [
        'line_user_id' => factory(LineUser::class)->create()->id,
        'hookevent_id' => factory(Hookevent::class)->create()->id,
        'line_id' => str_random(20),
    ];
});
