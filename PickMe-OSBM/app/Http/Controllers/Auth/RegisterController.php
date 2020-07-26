<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response as HTTPResponse;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        // $this->middleware('guest:web');
        // $this->middleware('guest:api');
        // $this->middleware('guest:student');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function registerAdmin(Request $data)
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
                $newAdmn = Admin::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'designation' => $data['designation'] ? $data['designation'] : 'Cashier',
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                ]);
                $accessToken = $newAdmn->createToken('adminToken')->accessToken;
                return response()->json([
                    'message' => 'Admin registered successfully.',
                    'accessToken' => $accessToken,
                    'data' => $newAdmn
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
}
