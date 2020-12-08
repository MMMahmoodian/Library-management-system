<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use \App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UsersController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;

    public function register(Request $request){
        $validation = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'national_code' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = $request->all();
        User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'national_code' => $data['national_code'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return View('auth.verify');

    }

    public function login(Request $request){
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = Auth::user();
            $token = $user->createToken('appToken')->accessToken;
            return response()->json([
                'status' => $this->successStatusCode,
                'data' => [
                    'token' => $token
                ]
            ]);
        } else {
            return response()->json([
                'status' => $this->badRequestStatusCode,
            ]);
        }
    }
}
