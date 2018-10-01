<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
      'name' => $faker->firstName,
      'surname' => $faker->lastName,
      'image' => "default-image.jpg",
      'email' => $faker->email,
      'favourite' => $faker->numberBetween(0, 1),
    ];
});
