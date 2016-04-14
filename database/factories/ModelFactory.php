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
  $password_plain = str_random(10);
  return [
    'name' => $faker->name,
    'email' => $faker->safeEmail,
    'username' => $faker->userName,
    'password' => $password_plain,
    'password' => bcrypt($password_plain),
    'api_token' => str_random(60),
    'remember_token' => str_random(10)
  ];
});
