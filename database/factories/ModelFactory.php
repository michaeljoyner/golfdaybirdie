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

$factory->define(App\Stock\ProductVersion::class, function (Faker\Generator $faker) {
    return [
        'product_id' => factory(\App\Stock\Product::class)->create()->id,
        'version_name' => $faker->words(3, true),
        'description' => $faker->paragraph(),
        'image_path' => 'default.jpg',
    ];
});

$factory->define(App\Announcement::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(5, false),
        'body' => $faker->paragraph(),
        'subscript' => $faker->sentence(),
    ];
});




