<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(10),
        'description' => $faker->text(250)
    ];
});
