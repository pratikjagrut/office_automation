<?php

use Faker\Generator as Faker;

$factory->define(App\NocConsumer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email_id' => $faker->unique()->safeEmail,
        'phone_number' => $faker->e164PhoneNumber,
        'city' => $faker->randomElement(['pune', 'kolhapur', 'nagpur', 'mumbai', 'surat', 'ahemadabad', 'vapi', 'bhopal', 'indore', 'gorakhpur']),
        'area' => $faker->city,
        'comment' => $faker->sentence(),
        'date' => $faker->dateTimeThisMonth($max = 'now'),
    ];
});
