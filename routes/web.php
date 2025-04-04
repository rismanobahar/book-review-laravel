<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome'); //this is the laravel default view that will be displayed when the user visit the root url
    // return redirect('/books'); //you can use this code to show the index layout or
    return redirect()->route('books.index'); // you can use this code for the same purpose
});

Route::resource('books', BookController::class) // this will create all the routes for the BookController
    ->only(['index', 'show']); // this will only create the index and show routes for the BookController
Route::resource('books.reviews', ReviewController::class) // this will create all the routes for the ReviewController
    ->scoped(['review' => 'book']) // this will create the routes for the review controller. scoped means that the review is related to the book
    ->only(['create', 'store']); // this will only create the create and store routes for the ReviewController