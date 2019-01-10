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

use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

//midleware auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/tasks', 'TasksController@index');
    Route::post('/tasks','TasksController@store');
    Route::put('/tasks/{id}','TasksController@update');
    Route::delete('/tasks/{id}','TasksController@destroy');

    Route::get('/task_edit/{id}','TasksController@edit');

    Route::post('/completed_task/{task}','CompletedTasksController@store');

    Route::delete('/completed_task/{task}','CompletedTasksController@destroy');

    Route::get('/tasks_vue', function (){
        return view('tasks_vue');
    });

    Route::get('/tasques', 'TasquesController@index');

    Route::get('/user/tasks','LoggedUserTasksController@index');

    //TAGS
    Route::get('/tags', 'TagsController@index');

    Route::get('/home', 'HomeController@index')->name('home');

    //Profile
    //Route::get('/profile', 'ProfileController@index');
    Route::get('/profile','\\'. ProfileController::class . '@index');
});



Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');



});

//Equivalent a login->loginCotroller
//Equivalent a register->registerController
Auth::routes();

Route::post('/login_alt','Auth\LoginAltController@login');
Route::post('/register_alt','Auth\RegisterAltController@register');

Route::impersonate();


