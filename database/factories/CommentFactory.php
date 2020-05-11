<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use App\Task;
use App\User;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text
    ];
});