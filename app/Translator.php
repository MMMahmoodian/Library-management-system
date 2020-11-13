<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    public function translators(){
        return $this->belongsToMany(Book::class, 'books_translators');
    }
}
