<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)// this is the function to show the data from the database 'Request $request' is the parameter to get the data from the database and show it to the user interface 
    {
        $title = $request->input('title'); //this is the variable to get the data from the database with the title column as the parameter. input means the data that is inputted by the user

        $books = Book::when( 
            $title, 
            fn($query, $title) => $query->title($title) //this is the query to get the data from the database with the title column as the parameter
        ) ->get(); //this is the method to get the data from the database

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
    public function show(string $id)
    {
        //
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
