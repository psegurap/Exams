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
    });
    
    Route::group(['prefix' => 'examenes'], function(){
        Route::get('/', 'ExamenController@all');
        Route::get('/create', 'ExamenController@create');
        Route::post('/store', 'ExamenController@store');
        Route::get('/llenar/{id}', 'ExamenController@llenar_examen');
        Route::get('/completado/{id}', 'ExamenController@examen_completado');
        Route::post('/store/respuestas', 'ExamenController@store_respuestas');
    });
    
    Route::group(['prefix' => 'materias'], function(){
        Route::get('/', 'MateriaController@all')->name('materias');
        Route::post('/store', 'MateriaController@store');
        Route::post('/update/{id}', 'MateriaController@update');
        Route::post('/delete/{id}', 'MateriaController@delete');
        Route::get('/llenar/{id}', 'MateriaController@llenar_examen');
        Route::get('/completado/{id}', 'MateriaController@examen_completado');
        Route::post('/store/respuestas', 'MateriaController@store_respuestas');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

