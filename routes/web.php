<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function(){

    Route::get('/', 'HomeController@index')->name('index');
    
    Route::group(['prefix' => 'usuarios'], function(){
        Route::get('/', 'HomeController@panel_usuarios')->name('panel_usuarios');
        Route::post('/update_rol/{role}/{id}/{estado}', 'HomeController@update_rol');
        Route::post('/update_estudiante/{id}/{materia}', 'HomeController@update_estudiante');
    });
    
    Route::group(['prefix' => 'examenes'], function(){
        Route::get('/', 'ExamenController@all');
        Route::get('/create', 'ExamenController@create');
        Route::get('/completados', 'ExamenController@all_completados');
        Route::post('/store', 'ExamenController@store');
        Route::post('/delete/{id}', 'ExamenController@delete_examen');
        Route::get('/editar/{id}', 'ExamenController@editar_examen');
        Route::post('/save_edit/{id}', 'ExamenController@save_edit');
        Route::get('/llenar/{id}', 'ExamenController@llenar_examen');
        Route::get('/completado/{id}', 'ExamenController@examen_completado');
        Route::get('/completado/calificar/{id}', 'ExamenController@calificar_completado');
        Route::post('/store/respuestas', 'ExamenController@store_respuestas');
        Route::post('/store/calificacion', 'ExamenController@store_calificacion');
        Route::post('/update_campo/{campo}/{id}/{estado}', 'ExamenController@update_campo');
        Route::post('/completados/update_campo/{campo}/{id}/{estado}', 'ExamenController@completados_update_campo');
    });
    
    Route::group(['prefix' => 'materias'], function(){
        Route::get('/', 'MateriaController@all')->name('materias');
        Route::post('/store', 'MateriaController@store');
        Route::post('/update/{id}', 'MateriaController@update');
        Route::post('/delete/{id}', 'MateriaController@delete');
        Route::get('/llenar/{id}', 'MateriaController@llenar_examen');
        Route::get('/completado/{id}', 'MateriaController@examen_completado');
        Route::post('/store/respuestas', 'MateriaController@store_respuestas');
        Route::post('/update_campo/{campo}/{id}/{estado}', 'MateriaController@update_campo');

    });

    Route::group(['prefix' => 'password'], function(){
        Route::get('change', 'ChangePasswordController@index');
        Route::post('change', 'ChangePasswordController@store')->name('change.password');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

