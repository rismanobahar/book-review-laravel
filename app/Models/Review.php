<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'rating']; //ensuring these specific filed can be mass assigned

    // this stating that this review model belong to the book model as one-to-one relationship
    public function book()  
    {
        return $this->belongsTo(Book::class);
    }
    
    //this code is used to cache the data from the database
    protected static function booted()
    {
        static::updated(fn(Review $review) => cache()->forget('book:' . $review->book_id)); //this is the method to cache the data from the database when the data is updated
        static::deleted(fn(Review $review) => cache()->forget('book:' . $review->book_id)); //this is the method to cache the data from the database when the data is deleted
        static::created(fn(Review $review) => cache()->forget('book:' . $review->book_id)); //this is the method to cache the data from the database when the data is created
    }
}