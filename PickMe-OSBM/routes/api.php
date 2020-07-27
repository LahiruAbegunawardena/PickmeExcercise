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

// Route::middleware('auth:student')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::POST('/admin/login', 'Auth\LoginController@adminLogin');

Route::POST('/admin/register', 'Auth\RegisterController@registerAdmin');
Route::POST('/student/register', 'Api\StudentApiController@registerStudent');
Route::POST('/student/login', 'Api\StudentApiController@studentLogin');
// Route::group([
//     'middleware' => 'student',
//     // 'prefix' => 'auth'
// ], function ($router) {
//     // Routes for Authenticated Student
// });
Route::middleware('auth:student')->group(function () {
    Route::POST('/student/logout', 'Api\StudentApiController@logout');
    Route::GET('/student/profile', 'Api\StudentApiController@profile');

    Route::GET('/my-courses', 'Api\CourseApiController@getMyCourses');
    Route::GET('/my-payments', 'Api\CourseApiController@getMyPayments');
});

