<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isbn', 'title', 'synopsis'
    ];

    /**
     * Get the publisher that published the book.
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * Get the category that owns the book.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class, 'books_authors');
    }

    public function translators(){
        return $this->belongsToMany(Translator::class, 'books_translators');
    }
}
