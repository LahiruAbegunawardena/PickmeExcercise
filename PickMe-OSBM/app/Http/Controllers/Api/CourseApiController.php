<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use App\Student;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response as HTTPResponse;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\BO\Services\StudentService;

class CourseApiController {

    protected $studentService;
    public function __construct(StudentService $studentService) {
        $this->studentService = $studentService;
    }

    public function getMyCourses() {
        try{
            $user = Auth::user();
            $courseList = $this->studentService->getCoursesByStudentId($user->id);
            return response()->json([
                'status' => true,
                'message' => 'Course List recieved',
                'data' => $courseList
            ]);
        } catch (Exception $ex){
            return response()->json([
                'message' => 'Exception Occured',
                'data' => $e->getMessage()
            ]);
        }
    }

    public function getMyPayments(){
        try{
            $user = Auth::user();
            $courseList = $this->studentService->getPaymentListByStudentId($user->id);
            return response()->json([
                'status' => true,
                'message' => 'Payment Deatails Recieved',
                'data' => $courseList
            ]);
        } catch (Exception $ex){
            return response()->json([
                'message' => 'Exception Occured',
                'data' => $ex->getMessage()
            ]);
        }
    }
}