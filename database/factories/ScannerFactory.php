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
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Scanner::class, function (Faker\Generator $faker) {
    
    static $autoIncrement = 3;

    return [
    	'line_id' => 1,
    	'lineprocess_id' => $autoIncrement++,
    	'name' => $faker->name, 
    	'mac_address' => $faker->macAddress,
    	'ip_address'=> $faker->ipv4
    ];
});
