<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'national_code', 'phone', 'mobile', 'address', 'postal_code', 'email', 'password', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function books(){
        return $this->belongsToMany(Book::class, 'rent_books');
    }

    public function rent($book_id, $rent_date){
        $this->books()->attach($book_id, ['renting_date' => $rent_date]);
    }

    public function withdraw($book_id, $withdraw_date){
        return $list = $this->books();
    }
}
