<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});
