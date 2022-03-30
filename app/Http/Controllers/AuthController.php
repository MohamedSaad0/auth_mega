<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    //User Register
    public function create() {
        return view('user.create');
    }


    public function register(Request $request) {

    //Register Validation
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

    //Insert a new user to the db
    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password'])
    ]);

    $token = $user->createToken('myAppToken')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    // return respon/se($response,201);
    return redirect()->route('/home');
    }

    // user login
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'string|required',
            'password' => 'string|required'
        ]);

        //check email

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
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
        return view('user.home');
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
