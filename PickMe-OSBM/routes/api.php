<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:student')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::POST('/admin/login', 'Auth\LoginController@adminLogin');
Route::POST('/admin/register', 'Auth\RegisterController@registerAdmin');
Route::POST('/student/register', 'Auth\RegisterController@register');
Route::POST('/student/login', 'Api\StudentApiController@studentLogin');
