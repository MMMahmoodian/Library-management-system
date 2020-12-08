<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $successStatusCode = 200;
    private $badRequestStatusCode = 401;
    private $forbiddenStatusCode = 403;
    private $notFoundStatusCode = 404;

    public function list(){

    }

    public function create(Request $request){

    }

    public function edit(Request $request, $bookId){

    }
}
