<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vacancy;
use Faker\Generator as Faker;

$factory->define(Vacancy::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'views' => 0,
        'owner_id' => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});
