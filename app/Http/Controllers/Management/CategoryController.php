<?php

namespace App\Http\Controllers\Management;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 400;
    private $unauthorizedStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;
    private $internalServerErrorStatusCode = 500;

    public function list(){
//        $user = Auth::user();
        $list = Category::all();
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
            'name' => ['required', 'string', 'max:255'],
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
        $category = new Category();
        $category->name = $data['name'];
        $category->save();

        if ($category){
            return response()->json([
                'status' => $this->successStatusCode,
                'message' => "Category created successfully!"
            ]);
        }

        return response()->json([
            'status' => $this->internalServerErrorStatusCode,
            'message' => 'Server internal error!'
        ]);

    }

    public function edit(Request $request){
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
        $category = Category::findOrFail($data['category_id']);
        $category->update($data);
        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "Category updated successfully!"
        ]);
    }

    public function delete(Request $request){
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
        $entity = Category::find($data['category_id'])->first();
        $entity->delete();
        if ($entity){
            return response()->json([
                'status_code' => $this->successStatusCode,
                'status_message' => 'Success',
                'data' => "Category deleted!"
            ]);
        }else{
            return response()->json([
                'status_code' => $this->internalServerErrorStatusCode,
                'status_message' => 'Internal server error',
            ]);
        }

    }
}
