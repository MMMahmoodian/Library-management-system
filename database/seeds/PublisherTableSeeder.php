<?php

use App\Publisher;
use Illuminate\Database\Seeder;

class PublisherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publisher::create([
            'name' => 'نشر سبزوار',
            'address' => "تهران انقلاب"
        ]);
    }
}
