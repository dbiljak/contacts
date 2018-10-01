<?php

use Faker\Generator as Faker;
use App\Contact;
use App\Label;

$factory->define(App\Phone::class, function (Faker $faker) {
    return [
      'contact_id' => function() {
        return Contact::all()->random();
      },
      'label_id' => function() {
        return Label::all()->random();
      },
      'phone_number' => $faker->phoneNumber,
    ];
});
