<?php

use App\Author;
use App\Book;
use App\Category;
use App\Publisher;
use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = Book::create([
            'isbn' => '123456789',
            'title' => "داستان یک فیروز",
            'synopsis' => 'کتاب راجع به یک فیروز است که در مسیر زندگی دچار سختی های عجیبی میشود.',
            'publisher_id' => Publisher::find(1),
            'category_id' => Category::find(1),
        ]);
        $book->authors()->attach(Author::find(1));
    }
}
