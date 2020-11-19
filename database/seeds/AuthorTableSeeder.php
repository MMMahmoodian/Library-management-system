<?php

use App\Author;
use Illuminate\Database\Seeder;


class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'first_name' => 'حسن',
            'last_name' => "تقی"
        ]);

        Author::create([
            'first_name' => 'امیر',
            'last_name' => "محمدی"
        ]);
    }
}
