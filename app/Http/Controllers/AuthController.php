<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\AuthController;
use App\Observers\AuthObserver;



class AuthController extends Controller
{
    //User Register
    public function create() {
        return view('user.create');
    }


    public function register(RegisterRequest  $request) {

    //Register Validation
        // $fields = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|string|unique:users,email',
        //     'password' => 'required|string|confirmed',
        // ]);

    //Insert a new user to the db
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);
    // settin create uers as admins
    $user->attachRole('admin');

    $token = $user->createToken('myAppToken')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];
    // return response($response,201);
    return redirect()->route('home');
    }

    // user login
    public function login(LoginRequest $request){
        $request = $request->validate([
            'email' => 'string|required',
            'password' => 'string|required'
        ]);

        //check email

        $user = User::where('email', $request['email'])->first();

        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                "Message" => "FALSE RUN"
            ], 401
        );
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];


        // return response ($response, 200);
        return redirect()->route('home');
   }


   public function logView() {

        return view('user.login');
   }

      // user logout

      public function logout(){
        auth()->user()->tokens()->delete();
        return response("Logged out successfully");
    }
}
