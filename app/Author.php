<?php

namespace App;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $hidden = ["created_at", "updated_at"];


    public function books(){
        return $this->belongsToMany(Book::class, 'books_authors');
    }
}
