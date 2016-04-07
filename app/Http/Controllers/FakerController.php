<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Faker\Factory as Faker;
use App\User;
use Hash;

class FakerController extends Controller
{
  public function index()
  {
    $limit = 10;
    $faker = Faker::create();
    User::truncate();

    $user = new User();
    $user->name = 'Mário Monteiro';
    $user->email = 'mail@koakh.com';
    $user->username = 'admin';
    $user->password_plain = 'fakepass';
    $user->password = Hash::make($user->password_plain);
    $user->save();

    for ($i = 0; $i < $limit; $i++) {
      $user = new User();
      $user->name = $faker->unique()->name;
      $user->email = $faker->unique()->email;
      $user->username = $faker->unique()->userName;
      $user->password_plain = $faker->unique()->password;
      https://laravel.com/docs/5.2/hashing
      $user->password = Hash::make($user->password_plain);

      $user->save();
    }

    $users = User::all();

    return view('faker.index')->withUsers($users);
  }
}
