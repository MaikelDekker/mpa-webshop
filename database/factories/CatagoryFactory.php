<?php

use Faker\Generator as Faker;

$factory->define(App\Catagory::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
