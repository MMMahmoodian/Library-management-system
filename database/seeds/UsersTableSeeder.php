<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => "Mahdi",
            'last_name' => "Mahmoodian",
            'national_code' => "1234567890",
            'phone' => "22334455",
            'mobile' => "09199069657",
            'address' => "Tehran, Tehran",
            'postal_code' => "12345",
            'email' => "mahmoodian.m1999@gmail.com",
            'password' => Hash::make("123456"),
        ]);
    }
}
