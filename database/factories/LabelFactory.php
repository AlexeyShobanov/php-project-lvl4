<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Label;
use Faker\Generator as Faker;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'color_id' => $faker->numberBetween(1,6),
    ];
});