<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        //
        'name'      => $faker->name,
        'age'       => rand(10, 60),
        'role_id'   => rand(1, 3)
    ];
});
