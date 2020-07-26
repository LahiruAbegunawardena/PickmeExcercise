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
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Container\BindingResolutionException;

class StudentApiController {
    public function __construct() {
        $this->middleware('auth:student', ['except' => ['login', 'register']]);
    }

    public function registerStudent(Request $data)
    {
        try {
            $validation = Validator::make($data->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:student',
                'password' => 'required|string|min:8'
            ]);
            if($validation->fails()){
                return response()->json([
                    'message' => 'validation failed',
                    'data' => $validation->errors()
                ]); 
            }
            else{
                $newStudent = Student::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'is_verified' => 0
                ]);
                return response()->json([
                    'message' => 'Student registered successfully.',
                    'studentData' => $newStudent
                ]);
            }
        } catch (QueryException $e){
            return response()->json([
                'message' => 'Exception Occured',
                // 'http_code' => $e->getHttpCode(),
                'data' => $e->getMessage()
            ]);
        }
    }

    public function studentLogin(Request $request){
        
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if($validation->fails()){
            return response()->json([
                'message' => 'validation failed',
                'data' => $validation->errors()
            ]);
        } else {

            $student = Student::where(['email'=> $request['email'], 'is_verified' => 1, 'is_deleted' => 0])->first();
            if (isset($student)) {
                if (! $token = auth()->attempt($request->all())) {
                    return response()->json(['token' => $token, 'message' => 'Unauthorized']);
                }

                return response()->json([
                    'status' => true,
                    'token_type' => 'bearer',
                    'access_token' => $token,
                    'userData' => $student
                ]);   
            } else {
                return response()->json(['status' => false, 'message' => 'Credentials are wrong or this user is not verified yet..']);
            }       
        }
        
    }

    public function profile()
    {
        try {
            
            return response()->json(['user' => Auth::guard('student')->user]);
        } catch (BindingResolutionException $ex){
            dd($ex->getMessage());

        }catch (Exception $ex) {
            dd($e->getMessage());
        }
        
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}