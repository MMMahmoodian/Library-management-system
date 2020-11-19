<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Publisher;
use Illuminate\Http\Request;

class ManagementCotroller extends Controller
{
    public function newBook(Request $request){
        $validation = $request->validate([
            'isbn' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string'],
            'publisher_id' => ['required', 'number', 'max:255'],
            'category_id' => ['required', 'number', 'max:255'],
            'author_id' => ['required', 'number', 'max:255'],
        ]);
        $data = $request->all();
        $book = Book::create([
            'isbn' => $data['isbn'],
            'title' => $data['title'],
            'synopsis' => $data['synopsis'],
            'publisher_id' => Publisher::find($data['publisher_id'])->id,
            'category_id' => Category::find($data['category_id'])->id,
        ]);
        $book->authors()->attach(Author::find($data['author_id'])->id);

        return View('');

    }

    public function newCategory(Request $request){
        $validation = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $data = $request->all();
        Category::create([
            'name' => $data['name'],
        ]);

        return View('');

    }

    public function newPublisher(Request $request){
        $validation = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
        ]);
        $data = $request->all();
        Publisher::create([
            'name' => $data['name'],
            'address' => $data['address'],
        ]);

        return View('');

    }
}
