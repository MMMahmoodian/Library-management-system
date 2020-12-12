<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'isbn', 'title', 'synopsis'
    ];

    protected $hidden = ['publisher_id', 'category_id', "created_at", "updated_at"];


    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class, 'books_authors');
    }

    public function translators(){
        return $this->belongsToMany(Translator::class, 'books_translators');
    }

    public function patrons(){
        return $this->belongsToMany(User::class, 'rent_books');
    }
}
