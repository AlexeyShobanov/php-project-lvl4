<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'status_id' => $faker->numberBetween(1,4),
        'created_by_id' => 1,
        'assigned_to_id' => 1,
    ];
});
