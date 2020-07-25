<?php

namespace App\Http\Controllers\Auth;

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

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest:web')->except('logout');
        // $this->middleware('guest:api')->except('logout');
        // $this->middleware('guest:student')->except('logout');
    }

    

    public function login(Request $request)
    {
        if(Auth::check()){
            return response()->json([
                'message' => 'Already logged in'
            ]);
        } else {
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
                if(Auth::attempt($credentials)){

                    $adminToken = Auth::user()->createToken('adminToken')->accessToken;
                    $request->session()->put('adminToken', $adminToken);            
                    $success['adminToken'] = $adminToken;
                    return redirect()->intended('admin/students');
                   
                } else {
                    return response()->json([
                        'message' => 'Admin login failed.'
                    ]);
                }
            }
        }

        
    }
}
