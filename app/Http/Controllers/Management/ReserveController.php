<?php

namespace App\Http\Controllers\Management;

use App\Book;
use App\Http\Controllers\Controller;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 400;
    private $unauthorizedStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;
    private $internalServerErrorStatusCode = 500;


    public function reserve(Request $request){
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
            $book->reserve($data['user_id'], new DateTime());
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

    public function cancel(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id' ],
            'book_id' => ['required', 'exists:books,id' ],
            'cancel_date' => ['required', 'date' ],
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
        $book->cancelReservation($data['user_id'], $data['cancel_date']);
        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "Rent withdrawn successfully!"
        ]);
    }

    public function getOnGoingReserves(){
        $list = DB::table('reserve_books')->where('cancel_date', '=', null)->get();
        foreach ($list as $reserve){
            $reserve->book = Book::find($reserve->book_id);
            $reserve->patron = User::find($reserve->user_id);
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

    public function getAllReserves(){
        $list = DB::table('reserve_books')->get();
        foreach ($list as $reserve){
            $reserve->book = Book::find($reserve->book_id);
            $reserve->patron = User::find($reserve->user_id);
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
