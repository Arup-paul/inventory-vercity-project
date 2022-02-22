<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Customers;
use Faker\Generator as Faker;

$factory->define(Customers::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mobile_no'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'address'=>$faker->address,
    ];
});
