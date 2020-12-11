<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

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

    }

    public function addStaff(Request $request){

    }

    public function editUser(Request $request){

    }
}
