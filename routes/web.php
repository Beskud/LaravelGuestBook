<?php

use App\Http\Controllers\ControllerLogout;
use App\Http\Middleware\ValidationUserMethod;
use Illuminate\Support\Facades\Route;

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

Route::get('/authorization', 'ControllerAuthorization@index');  
Route::post('/authorization-action', 'ControllerAuthorization@authorization');

Route::get('/registration', 'ControllerRegistration@index');
Route::post('/registration-action', 'ControllerRegistration@registration')->middleware(ValidationUserMethod::class);

Route::get('/main', 'ControllerMain@index');
Route::post('/set/comment', 'ControllerMain@setComment');
Route::get('/get/comment', 'ControllerMain@getComment');
Route::post('/main/changeUserAvatar', 'ControllerMain@changeUserAvatar');
Route::post('/main/remove', 'ControllerMain@remove');

Route::get('/logout', 'ControllerLogout@index');












