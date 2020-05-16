<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text
    ];
});