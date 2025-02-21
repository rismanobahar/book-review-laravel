<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory(33)->create()->each(function ($book){ //create 33 book for dummy/fake data
            $numReviews = random_int(5, 30); //generate the number of review to be atleast 5 and 30 at maximum for each book

            Review::factory()->count($numReviews) //create the reviews model
                ->good() //all the rating will be categorized as good by this program
                ->for($book) //send this data to book id column
                ->create(); //create the model and save it
        });

        Book::factory(33)->create()->each(function ($book){ //create 33 book for dummy/fake data
            $numReviews = random_int(5, 30); //generate the number of review to be atleast 5 and 30 at maximum for each book

            Review::factory()->count($numReviews) //create the reviews model
                ->average() //all the rating will be categorized as average by this program
                ->for($book) //send this data to book id column
                ->create(); //create the model and save it
        });

        Book::factory(34)->create()->each(function ($book){ //create 33 book for dummy/fake data
            $numReviews = random_int(5, 30); //generate the number of review to be atleast 5 and 30 at maximum for each book

            Review::factory()->count($numReviews) //create the reviews model
                ->bad() //all the rating will be categorized as bad by this program
                ->for($book) //send this data to book id column
                ->create(); //create the model and save it
        });
    }
}
