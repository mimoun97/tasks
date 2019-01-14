<?php

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(10),
        'completed' => $faker->boolean(50),
        'description' => $faker->text(250)
    ];
});
