<?php

namespace App\Http\Controllers\Management;

use App\Author;
use App\Book;
use App\Http\Controllers\Controller;
use App\Translator;
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
        foreach ($list as $book){
            $book->avaiable = $book->isAvailable();
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

    public function listPublisher(Request $request){
        $validation = Validator::make($request->all(), [
            'publisher_id' => ['required', 'exists:categories,id' ],
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
        $list = Book::where('publisher_id', $data["publisher_id"])->with(['publisher', 'category', 'authors', 'translators'])->get();
        foreach ($list as $book){
            $book->avaiable = $book->isAvailable();
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

    public function listCategory(Request $request){
        $validation = Validator::make($request->all(), [
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
        $list = Book::where('category_id', $data["category_id"])->with(['publisher', 'category', 'authors', 'translators'])->get();
        foreach ($list as $book){
            $book->avaiable = $book->isAvailable();
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



    public function getSingleBook(Request $request){
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
        $book = Book::find($data['book_id'])->with(['publisher', 'category', 'authors', 'translators'])->first();
        $book->avaiable = $book->isAvailable();
        if ($book){
            return response()->json([
                'status_code' => $this->successStatusCode,
                'status_message' => 'Success',
                'data' => $book
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
        if (isset($data['author_id'])){
            $book->authors()->save(Author::find($data['author_id']));
        }
        if (isset($data['translator_id'])){
            $book->translators()->save(Translator::find($data['translator_id']));
        }
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
        if (isset($data['isbn'])){
            $book->isbn = $data['isbn'];
        }
        if (isset($data['title'])){
            $book->title = $data['title'];
        }
        if (isset($data['synopsis'])){
            $book->synopsis = $data['synopsis'];
        }
        if (isset($data['publisher_id'])){
            $book->publisher_id = $data['publisher_id'];
        }
        if (isset($data['category_id'])){
            $book->category_id = $data['category_id'];
        }
        $book->save();
        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "Book updated successfully!"
        ]);
    }

    public function search(Request $request){
        $data = $request->all();
        $query = Book::query();
        if (isset($data['title'])){
            $query = $query->where('title', 'like', '%'.$data['title'].'%');
        }
        if (isset($data['synopsis'])){
            $query = $query->where('synopsis', 'like', '%'.$data['synopsis'].'%');
        }
        if (isset($data['isbn'])){
            $query = $query->where('isbn', 'like', '%'.$data['isbn'].'%');
        }
        if (isset($data['category'])){
            $query = $query->WhereHas('category', function($q) use ($data){
                $q->where([
                    'name', 'like', '%'.$data['category'].'%',
                ]);
            });
        }
        if (isset($data['publisher'])){
            $query = $query->WhereHas('publisher', function($q) use ($data){
                $q->where([
                    'name', 'like', '%'.$data['publisher'].'%',
                ]);
            });
        }
        if (isset($data['author_first_name'])){
            $query = $query->WhereHas('authors', function($q) use ($data){
                $q->where([
                    'first_name', 'like', '%'.$data['author_first_name'].'%',
                ]);
            });
        }
        if (isset($data['author_last_name'])){
            $query = $query->WhereHas('authors', function($q) use ($data){
                $q->where([
                    'last_name', 'like', '%'.$data['author_last_name'].'%',
                ]);
            });
        }
        if (isset($data['translator_first_name'])){
            $query = $query->WhereHas('translators', function($q) use ($data){
                $q->where([
                    'first_name', 'like', '%'.$data['author_first_name'].'%',
                ]);
            });
        }
        if (isset($data['translator_last_name'])){
            $query = $query->WhereHas('translators', function($q) use ($data){
                $q->where([
                    'last_name', 'like', '%'.$data['author_last_name'].'%',
                ]);
            });
        }
        $list = $query->with(['publisher', 'category', 'authors', 'translators'])->get();
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

    public function delete(Request $request){
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
        $entity = Book::find($data['book_id'])->first();
        $entity->delete();
        if ($entity){
            return response()->json([
                'status_code' => $this->successStatusCode,
                'status_message' => 'Success',
                'data' => "Book deleted!"
            ]);
        }else{
            return response()->json([
                'status_code' => $this->internalServerErrorStatusCode,
                'status_message' => 'Internal server error',
            ]);
        }

    }
}
