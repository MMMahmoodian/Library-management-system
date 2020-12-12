<?php

namespace App\Http\Controllers\Management;

use App\Book;
use App\Http\Controllers\Controller;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RentingController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 400;
    private $unauthorizedStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;
    private $internalServerErrorStatusCode = 500;


    public function rent(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id' ],
            'book_id' => ['required', 'exists:books,id' ],
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
        $book = Book::findOrFail($data['book_id']);
        if ($book->isAvailable()){
            $book->rent($data['user_id'], new DateTime());
            return response()->json([
                'status' => $this->successStatusCode,
                'message' => "Rent submitted successfully!"
            ]);
        }
        return response()->json([
            'status' => $this->badRequestStatusCode,
            'message' => 'Bad request!',
            'data' => [
                'error' => 'Book is not available!'
            ]
        ]);

    }

    public function withdraw(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id' ],
            'book_id' => ['required', 'exists:books,id' ],
            'withdraw_date' => ['required', 'date' ],
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
        $book = Book::findOrFail($data['book_id']);
        $book->withdraw($data['user_id'], $data['withdraw_date']);
        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "Rent withdrawn successfully!"
        ]);
    }

    public function getOnGoingRents(){
        $list = DB::table('rent_books')->where('withdraw_date', '=', null)->get();
        foreach ($list as $rent){
            $rent->book = Book::find($rent->book_id);
            $rent->patron = User::find($rent->user_id);
        }
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

    public function getAllRents(){
        $list = DB::table('rent_books')->get();
        foreach ($list as $rent){
            $rent->book = Book::find($rent->book_id);
            $rent->patron = User::find($rent->user_id);
        }
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
}
