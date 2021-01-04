<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
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

    public function getStaffs(){
        $list = User::whereHas(
            'roles', function($q){
                $q->where('slug', 'staff');
            })->get();
        if ($list){
            return response()->json([
                'status_code' => $this->successStatusCode,
                'status_message' => 'Success',
                'data' => $list
            ]);
        }else{
            return response()->json([
                'status_code' => $this->internalServerErrorStatusCode,
                'status_message' => 'Internal server error',
            ]);
        }
    }

    public function getPatrons(){
        $list = User::whereHas(
            'roles', function($q){
            $q->where('slug', 'patron');
        })->get();
        if ($list){
            return response()->json([
                'status_code' => $this->successStatusCode,
                'status_message' => 'Success',
                'data' => $list
            ]);
        }else{
            return response()->json([
                'status_code' => $this->internalServerErrorStatusCode,
                'status_message' => 'Internal server error',
            ]);
        }
    }

    public function verifyPatron(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id' ],
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
        $user = User::findOrFail($data['user_id']);
        if (!$user->verified){
            $user->verified = true;
            $user->save();
            return response()->json([
                'status' => $this->successStatusCode,
                'message' => "Patron verified!"
            ]);
        }

        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "Patron is already verified!"
        ]);


    }

    public function addStaff(Request $request){
        $staff_role = Role::where('slug', 'staff')->first();
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
            'verified' => true,
        ]);
        if ($user){
            $user->roles()->save($staff_role);
            return response()->json([
                'status' => $this->successStatusCode,
                'message' => "Staff created successfully!"
            ]);
        }

        return response()->json([
            'status' => $this->internalServerErrorStatusCode,
            'message' => 'Server internal error!'
        ]);
    }

    public function editUser(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id' ],
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
        $user = User::findOrFail($data['user_id']);
        $user->update($data);
        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "User updated successfully!"
        ]);
    }

    public function getUser(Request $request){

    }

    public function delete(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id' ],
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
        $entity = User::find($data['user_id'])->first();
        $entity->delete();
        if ($entity){
            return response()->json([
                'status_code' => $this->successStatusCode,
                'status_message' => 'Success',
                'data' => "User deleted!"
            ]);
        }else{
            return response()->json([
                'status_code' => $this->internalServerErrorStatusCode,
                'status_message' => 'Internal server error',
            ]);
        }

    }
}
