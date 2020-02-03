<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Pedido::class, function (Faker $faker) {
    $path = 'public/storage/images/';

    return [
        'status' => $faker->randomElement([$path . 'baseline-check_circle_outline.svg', $path . 'baseline-highlight_off.svg']),
        'adress' => $faker->address,
        'peca_id' => App\Peca::all(['id'])->random(),
        'user_id' => App\User::all(['id'])->random()
    ];
});
