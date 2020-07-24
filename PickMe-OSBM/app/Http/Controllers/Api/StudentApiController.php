<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response as HTTPResponse;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Auth;
use App\Admin;
use App\Student;
use Illuminate\Support\Facades\Hash;

class StudentApiController {
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
            $credentials = ['email'=> $request['email'], 'password' => $request['password']];

            $selectedStudent = Student::where(['email'=> $request['email'], 'is_deleted'=>0, 'is_verified'=>1]);
            dd($selectedStudent);
            if(Auth::guard('student')->attempt($credentials)){
                $studentToken = Auth::guard('student')->user()->createToken('studentToken')->accessToken;
                
                $request->session()->put('studentToken', $adminToken);            
                $success['studentToken'] = $adminToken;
                                    
                return response()->json([
                    'status' => true,
                    'message' => 'Student loggedIn successfully.',
                    'data' => $success,
                    'session_data' =>  $request->session()->all()
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Student login failed.. Check whether you are verified..'
                ]);
            }                
        }
        
    }
}