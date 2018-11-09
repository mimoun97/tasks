<?php

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'color' => $faker->hexColor,
        'description' => str_random(50),
    ];
});
