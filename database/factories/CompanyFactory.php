<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'display_name' => $faker->name,
        'description' => $faker->name,
    ];
});
