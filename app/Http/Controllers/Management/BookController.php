<?php

namespace App\Http\Controllers\Management;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 400;
    private $unauthorizedStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;
    private $internalServerErrorStatusCode = 500;

    public function list(){
//        $user = Auth::user();
        $list = Book::with(['publisher', 'category', 'authors', 'translators'])->get();
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

    public function create(Request $request){
        $validation = Validator::make($request->all(), [
            'isbn' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string'],
            'publisher_id' => ['required', 'exists:publishers,id'],
            'category_id' => ['required', 'exists:categories,id' ],
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
        $book = new Book();
        $book->isbn = $data['isbn'];
        $book->title = $data['title'];
        $book->synopsis = $data['synopsis'];
        $book->publisher_id = $data['publisher_id'];
        $book->category_id = $data['category_id'];
        $book->save();

        if ($book){
            return response()->json([
                'status' => $this->successStatusCode,
                'message' => "Book created successfully!"
            ]);
        }

        return response()->json([
            'status' => $this->internalServerErrorStatusCode,
            'message' => 'Server internal error!'
        ]);

    }

    public function edit(Request $request){
        $validation = Validator::make($request->all(), [
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
        $book->update($data);
        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "Book updated successfully!"
        ]);
    }
}
