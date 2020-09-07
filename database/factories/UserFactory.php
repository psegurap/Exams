<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

//------------- Users Table -------------//
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'status' => 1,
        'estudiante' => $faker->randomElement([0,1]),
        'facilitador' => $faker->randomElement([0,1]),
        'administrador' => $faker->randomElement([0,1]),
        'remember_token' => Str::random(10)
    ];
});

//------------- Materias Table -------------//
$factory->define(App\Materia::class, function (Faker $faker) {
    return [
        'materia' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'facilitador_id' => factory(App\User::class),
        'status' => 1,
        'deleted_at' => NULL
    ];
});

//------------- Examenes Table -------------//
$factory->define(App\Examen::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'materia' => factory(App\Materia::class),
        'descripcion' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'facilitador_id' => 1,
        'status' => 1,
        'deleted_at' => NULL
    ];
});

//------------- Temas Table -------------//
$factory->define(App\Tema::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        'tipo_pregunta' => $faker->randomElement(['falsoVerdadero', 'completa', 'selectMultiple', 'texto_libre']),
        'examen_id' => 0,
        'status' => 1,
        'deleted_at' => NULL
    ];
});

//------------- Preguntas Table -------------//
$factory->define(App\Pregunta::class, function (Faker $faker) {
    return [
        'pregunta' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        'select_options' => implode("||", $faker->words($nb = 4, $asText = false)),
        'tema_id' => 0,
        'status' => 1,
        'deleted_at' => NULL
    ];
});