<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 400;
    private $unauthorizedStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;
    private $internalServerErrorStatusCode = 500;

    public function register(Request $request){
        $patron_role = Role::where('slug', 'patron')->first();
        $validation = Validator::make($request->all(), [
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
        if ($validation->fails()){
            return response()->json([
                'status' => $this->badRequestStatusCode,
                'message' => 'Bad request!',
                'data' => [
                    'error' => $validation->messages()->first()
                ]
            ]);
        }
        $data = $request->all();
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'national_code' => $data['national_code'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
            'verified' => false,
        ]);
        if ($user){
            $user->roles()->save($patron_role);
            return response()->json([
                'status' => $this->successStatusCode,
                'message' => "User created successfully!"
            ]);
        }

        return response()->json([
            'status' => $this->internalServerErrorStatusCode,
            'message' => 'Server internal error!'
        ]);

    }

    public function login(Request $request){
        $validation = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        if ($validation->fails()){
            return response()->json([
                'status' => $this->badRequestStatusCode,
                'message' => 'Bad request',
                'data' => [
                    'error' => $validation->messages()->first()
                ]
            ]);
        }
        if (Auth::attempt(['email' => strtolower($request['email']), 'password' => $request['password']])) {
            $user = Auth::user();
            if ($user->verified){
                $token = $user->createToken('appToken')->accessToken;
                return response()->json([
                    'status' => $this->successStatusCode,
                    'message' => "Login success!",
                    'data' => [
                        'token' => $token,
                        'role' => $user->roles
                    ]
                ]);
            }
            return response()->json([
                'status' => $this->forbiddenStatusCode,
                'message' => "Forbidden!",
            ]);
        } else {
            return response()->json([
                'status' => $this->unauthorizedStatusCode,
                'message' => "Unauthorized!",
            ]);
        }
    }
}
