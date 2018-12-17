<?php

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'completed' => $faker->boolean(50),
        'description' => $faker->text(200)
    ];
});
