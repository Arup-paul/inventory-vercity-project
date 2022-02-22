<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'supplier_id' => mt_rand(1,10),
        'unit_id' => mt_rand(1,3),
        'category_id' => mt_rand(1,4),
        'name'=>$faker->word,
        'quantity'=>mt_rand(20,50),
    ];
});
