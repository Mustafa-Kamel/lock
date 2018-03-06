<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->state,
        'slug'  => $faker->slug,
        'img'   => $faker->imageUrl(640, 480, 'city')
    ];
});
