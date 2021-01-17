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

    public function reserves(){
        return $this->belongsToMany(User::class, 'reserve_books');
    }

    public function reserve($user_id, $reserve_date){
        $this->reserves()->attach($user_id, ['reserve_date' => $reserve_date]);
    }

    public function rent($user_id, $rent_date){
        $this->patrons()->attach($user_id, ['renting_date' => $rent_date]);
    }

    public function cancelReservation($user_id, $cancel_date){
        return $list = $this->reserves()->updateExistingPivot($user_id, ['withdraw_date' => $cancel_date]);
    }

    public function withdraw($user_id, $withdraw_date){
        return $list = $this->patrons()->updateExistingPivot($user_id, ['withdraw_date' => $withdraw_date]);
    }

    public function isRented(){
        $rents = $this->patrons()->where('withdraw_date', '=',null);
        return $rents->exists();
    }
    public function isReserved(){
        $reserves = $this->reserves()->where('cancel_date', '=',null);
        return $reserves->exists();
    }
    public function isAvailable(){
        return !$this->isRented() && !$this->isReserved();
    }
}
