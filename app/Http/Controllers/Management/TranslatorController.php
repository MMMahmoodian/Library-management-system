<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Translator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TranslatorController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 400;
    private $unauthorizedStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;
    private $internalServerErrorStatusCode = 500;

    public function list(){
//        $user = Auth::user();
        $list = Translator::all();
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
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
        $translator = new Translator();
        $translator->first_name = $data['first_name'];
        $translator->last_name = $data['last_name'];
        $translator->save();

        if ($translator){
            return response()->json([
                'status' => $this->successStatusCode,
                'message' => "Translator created successfully!"
            ]);
        }

        return response()->json([
            'status' => $this->internalServerErrorStatusCode,
            'message' => 'Server internal error!'
        ]);

    }

    public function edit(Request $request){
        $validation = Validator::make($request->all(), [
            'translator_id' => ['required', 'exists:translators,id' ],
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
        $translator = Translator::findOrFail($data['translator_id']);
        $translator->update($data);
        return response()->json([
            'status' => $this->successStatusCode,
            'message' => "Translator updated successfully!"
        ]);
    }

    public function delete(Request $request){
        $validation = Validator::make($request->all(), [
            'translator_id' => ['required', 'exists:translators,id' ],
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
        $entity = Translator::find($data['translator_id'])->first();
        $entity->delete();
        if ($entity){
            return response()->json([
                'status_code' => $this->successStatusCode,
                'status_message' => 'Success',
                'data' => "Translator deleted!"
            ]);
        }else{
            return response()->json([
                'status_code' => $this->internalServerErrorStatusCode,
                'status_message' => 'Internal server error',
            ]);
        }

    }
}
