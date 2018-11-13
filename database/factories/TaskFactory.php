<?php

use App\Task;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'completed' => $faker->boolean,
        'user_id' => $faker->number,
    ];
});
