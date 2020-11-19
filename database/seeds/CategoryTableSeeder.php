<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'جنایی',
        ]);

        Category::create([
            'name' => 'تاریخی',
        ]);

        Category::create([
            'name' => 'داستانی',
        ]);
    }
}
