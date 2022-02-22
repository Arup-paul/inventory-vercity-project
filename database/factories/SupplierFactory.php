<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mobile_no'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'address'=>$faker->address,
    ];
});
