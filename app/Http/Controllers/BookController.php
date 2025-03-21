<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)// this is the function to show the data from the database 'Request $request' is the parameter to get the data from the database and show it to the user interface 
    {
        $title = $request->input('title'); //this is the variable to get the data from the database with the title column as the parameter. input means the data that is inputted by the user
        $filter = $request->input('filter', ''); //this is the variable to get the data from the database with the filter column as the parameter. input means the data that is inputted by the user. the default value is empty for showing the latest data

        $books = Book::when( 
            $title, //this is the condition to get the data from the database with the title column as the parameter
            fn($query, $title) => $query->title($title) //this is the query to get the data from the database with the title column as the parameter
        );
        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(), //this is the query to get the data from the database with the most popular based on reviews last month
            'popular_last_6months' => $books->popularLast6Months(), //this is the query to get the data from the database with the most popular based on reviews last 6 months
            'highest_rated_last_month' => $books->highestRatedLastMonth(), //this is the query to get the data from the database with the highest rated based on rating last month
            'highest_rated_last_6months' => $books->highestRatedLastMonth(), //this is the query to get the data from the database with the highest rated based on rating last 6 months 
            default => $books->latest(), //this is the default value to show the latest data
        };
        // $books = $books->get(); //this is the method to get the data from the database. using the books variable because there are many queries before. not using this anymore because we want to cache the data from the database

        $cacheKey = 'books:' . $filter . $title; //this is the variable to cache the data from the database with the filter and title column as the parameter

        // $books = Cache::remember('books', 3600, fn() => $books->get()); //this is the method to cache the data from the database with the books variable as the parameter
        
        $books = cache()->remember($cacheKey, 3600, fn() => $books->get()); // this is another way to cache the data from the database with the books variable as the parameter

        // The below code is used to check if the data is from the cache or not
        
        // $books = cache()->remember($cacheKey, 3600, function() use ($books){
        //     dd('Not from Cache');
        //     return $books->get();
        // });

        return view('books.index', ['books' => $books]); //this is the view to show the data from the database to the user interface with 'books.index' as the parameter
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $cacheKey = 'book:' . $book->id; //this is the variable to cache the data from the database with the book id as the parameter

        $book = cache()->remember($cacheKey, 3600, fn() => $book->load(['reviews' => fn($query) => $query->latest()
        ])); //this is the method to cache the data from the database with the book variable as the parameter

        return view('books.show',['book' => $book]); //this is the view to show the data from the database to the user interface with 'books.show' as the parameter    
    }   

    /**
     * Show the form for editing the specified resource. 
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
