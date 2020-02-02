<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Peca::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'user_id' => App\User::all(['id'])->random()
    ];
});
