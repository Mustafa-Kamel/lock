<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull,
        'post_id' => $faker->randomDigitNotNull,
        'body'      => $faker->realText()
    ];
});
