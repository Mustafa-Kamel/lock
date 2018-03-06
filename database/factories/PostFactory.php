<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id'       => $faker->randomDigitNotNull,
        'category_id'   => $faker->randomDigitNotNull,
        'title'         => $faker->words(3, true),
        'slug'          => $faker->slug,
        'body'          => $faker->paragraphs(3, true),
        'img'           => $faker->imageUrl(640, 480, 'technics')
    ];
});
