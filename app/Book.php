<?php

namespace App;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function authors(){
        return $this->belongsToMany(Author::class, 'books_authors');
    }
}
