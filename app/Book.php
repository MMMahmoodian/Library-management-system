<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function authors(){
        return $this->belongsToMany(Author::class, 'books_authors');
    }

    public function translators(){
        return $this->belongsToMany(Translator::class, 'books_translators');
    }
}
