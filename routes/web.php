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

use App\Http\Controllers\ClockController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasquesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Game\GamePadController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\Newsletters\NewslettersController;

Route::get('/', function () {
    return view('welcome');
});

//midleware auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/tasks', 'TasksController@index');
    Route::post('/tasks', 'TasksController@store');
    Route::put('/tasks/{id}', 'TasksController@update');
    Route::delete('/tasks/{id}', 'TasksController@destroy');

    Route::get('/task_edit/{id}', 'TasksController@edit');

    Route::post('/completed_task/{task}', 'CompletedTasksController@store');

    Route::delete('/completed_task/{task}', 'CompletedTasksController@destroy');

    Route::get('/tasks_vue', 'TasksVueController@index');

    Route::get('/tasques', 'TasquesController@index');
    // TODO LINK TASCA
    Route::get('/tasques/{id}', '\\' . TasquesController::class . '@show')->name('tasca.show');

    Route::get('/user/tasks', 'LoggedUserTasksController@index');

    //TAGS
    Route::get('/tags', 'TagsController@index');

    Route::get('/home', 'HomeController@index')->name('home');

    //Profile
    //Route::get('/profile', 'ProfileController@index');
    Route::get('/profile', '\\' . ProfileController::class . '@index');

    Route::post('/photo', '\\' . PhotoController::class . '@store');

    Route::get('/user/photo', '\\' . LoggedUserPhotoController::class . '@show');
    Route::put('/user/photo', '\\' . LoggedUserPhotoController::class . '@update');

    Route::get('/settings', '\\' . SettingsController::class . '@index');

    Route::get('/changelog', '\\' . ChangelogController::class . '@index');

    Route::get('/notifications', '\\' . NotificationController::class . '@index');

    // Push Subscriptions
    Route::post('subscriptions', 'PushSubscriptionController@update');
    Route::post('subscriptions/delete', 'PushSubscriptionController@destroy');

    Route::get('/device-features', function () {
        return view('device');
    });

    Route::get('/contact', function () {
        return view('contact');
    });
    
    Route::get('/about', function () {
        return view('about');
    });

    Route::get('/screenshots', function () {
        return view('screenshots');
    });

    Route::get('/clock', '\\' . ClockController::class . '@index');

    Route::get('/newsletters', '\\' . NewslettersController::class . '@index');

    //chat
    Route::get('/chat', '\\' . ChatController::class . '@index');
    Route::get('/xat', '\\' . ChatController::class . '@index');

    //game
    Route::get('/gamepad', '\\' . GamePadController::class . '@index');
});

//Equivalent a login->loginCotroller
//Equivalent a register->registerController
Auth::routes(['verify' => true]);

Route::post('/login_alt', 'Auth\LoginAltController@login');
Route::post('/register_alt', 'Auth\RegisterAltController@register');

Route::impersonate();
