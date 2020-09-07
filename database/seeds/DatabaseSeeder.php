<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        // DB::table('users')->truncate();
        // DB::table('materias')->truncate();
        // DB::table('examenes')->truncate();
        // DB::table('temas')->truncate();
        // DB::table('preguntas')->truncate();
        
        // factory(App\User::class, 5)->create()->each(function($user){
        //     if($user->facilitador == 1){
        //         factory(App\Materia::class, 1)->create([
        //             'facilitador_id' => $user->id
        //         ])->each(function($materia) use ($user){
        //             factory(App\Examen::class, 1)->create([
        //                 'materia' => $materia->id,
        //                 'facilitador_id' => $user->id
        //             ])->each(function($examen){
        //                 factory(App\Tema::class, 5)->create([
        //                     'examen_id' => $examen->id
        //                 ])->each(function($tema){
        //                     if($tema->tipo_pregunta != 'selectMultiple'){
        //                         factory(App\Pregunta::class, 5)->create([
        //                             'select_options' => NULL,
        //                             'tema_id' => $tema->id
        //                         ]);
        //                     }else{
        //                         factory(App\Pregunta::class, 5)->create([
        //                             'tema_id' => $tema->id
        //                         ]);
        //                     }
        //                 });
        //             });
        //         });
        //     }
        // });
    }
}
