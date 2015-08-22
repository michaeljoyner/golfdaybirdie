<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Stock\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(),
        'image_path' => 'default.jpg',
    ];
});

$factory->define(App\Stock\Product::class, function (Faker\Generator $faker) {
    return [
        'category_id' => 1,
        'name' => $faker->words(3, true),
        'description' => $faker->paragraph(),
        'quantity' => $faker->numberBetween(1, 24),
        'image_path' => 'default.jpg',
    ];
});

$factory->define(\App\Quotes\QuoteRequest::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'enquiry' => $faker->paragraphs(3, true)
    ];
});

$factory->define(\App\Quotes\QuoteProduct::class, function(Faker\Generator $faker) {
    return [
        'quote_request_id' => 1,
        'product_name' => $faker->name,
        'quantity' => $faker->numberBetween(12, 120)
    ];
});

$factory->define(\App\Quotes\QuoteImage::class, function(Faker\Generator $faker) {
    return [
        'quote_request_id' => 1,
        'image_path' => 'default.jpg'
    ];
});


