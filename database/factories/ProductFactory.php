<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence,
        'catagory' => $faker->word,
        'price' => $faker->randomDigit,
        'amount' => 1,
    ];
});
