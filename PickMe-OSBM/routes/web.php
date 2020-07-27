<?php

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

Route::get('/', function () {
    if(!Auth::guard('web')){
        return view('welcome');
    }
    return redirect()->route('studentMgt');

});

// Auth::routes();
Auth::routes(['register' => false]);

Route::middleware('auth:web')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin/students', 'Admin\StudentController@index')->name('studentMgt');
    Route::get('/admin/student/{student_id}/verify', 'Admin\StudentController@verifyStudent');
    Route::get('/admin/student/{student_id}/delete', 'Admin\StudentController@deleteStudent');
    Route::get('/admin/student/{student_id}/enroll', 'Admin\StudentController@enrollStudentToCourses');
    Route::post('/admin/student/{student_id}/complete-enroll/{course_id}', 'Admin\StudentController@completeEnrollment');
    Route::get('/admin/student-payments', 'Admin\PaymentController@getPaymentList')->name('paymentMgt');
    Route::get('/admin/payments/{payment_id}/fix', 'Admin\PaymentController@settlePayment')->name('settlePayment');

    Route::get('/admin/courses', 'Admin\CourseController@index')->name('courseMgt');
    Route::get('/admin/courses/create', 'Admin\CourseController@create')->name('courseCreate');
    Route::post('/admin/courses/store', 'Admin\CourseController@store')->name('courseStore');
});