<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * 
     */

    public function __construct()
    {
        $this->middleware('throttle:reviews')->only(['store']); //apply rate limiting to the store method. the throttle middleware is used to limit the number of requests to a given route. In this case, we are limiting the store method to 3 requests per hour.
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('books.reviews.create', ['book' => $book]); //return the view for creating a review
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $data = $request->validate([ //add validation rules
            'review' => 'required|min:15', //minimum 15 characters
            'rating' => 'required|min:1|max:5|integer' //1-5 rating
        ]);

        $book->reviews()->create($data); //create a new review

        return redirect()->route('books.show', $book); //redirect to the book show page
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
