<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Nayourown\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' =>$faker->unique()->phoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'activation_token' => str_random(60),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Nayourown\Report::class, function(Faker $faker){
    return [
        'finder_id' =>function(){
            return factory(Nayourown\User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'category_id' => function(){
            return factory(Nayourown\Category::class)->create()->id;
        },
    ];
});

$factory->define(Nayourown\Category::class, function(Faker $faker){
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => $name
    ];
});


$factory->define(Nayourown\Claim::class, function(Faker $faker){
    return [
        'claimant_id' =>function(){
            return factory(Nayourown\User::class)->create()->id;
        },
        'statement' => $faker->paragraph,
        'report_id' => function(){
            return factory(Nayourown\Report::class)->create()->id;
        },
    ];
});
