<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder; //make the error sign disappear
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function reviews() 
    {
        // this stating that the book model has one-to-many relationship with review model
        return $this->hasMany(Review::class);
    }

    // this code make database query easier rather than using tinker
    public function scopeTitle(Builder $query, String $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    //the two below function are used for sorting the data by the most popular reviews and average rating

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withCount(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)]);
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withAvg(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)], 'rating');
    }

    //to query the reviews column and order the element by reviews_count in descendant order
    public function scopePopular(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withReviewsCount()
        // return $query->withCount([ //this is the unseparated method
        //     'reviews' => function (Builder $q) use ($from, $to) {
        //         if ($from && !$to) {
        //             $q->where('created_at', '>=', $from);
        //         } elseif (!$from && $to) {
        //             $q->where('created_at', '<=', $to);   
        //         } elseif ($from && $to) {
        //             $q->whereBetween('created_at', [$from, $to]);
        //         }
        //     }
        // ])
        ->orderBy('reviews_count', 'desc');
    }

    // to query the reviews and rating to find the average rating in descendant order
    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {  
        return $query->withAvgRating()
        ->orderBy('reviews_avg_rating', 'desc');
    }

    //query to find
    private function dateRangeFilter(Builder $query, $from = null, $to = null)
    {
        if ($from && !$to) {    
            $query->where('created_at', '>=', $from);
        } elseif (!$from && $to) {
            $query->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }  
    }

    //query to find the most popular book in the last month
    public function scopePopularLastMonth(Builder $query): Builder|QueryBuilder
    {
        return $query->popular(now()->subMonth(), now())
        ->highestRated(now()->subMonth(), now())
        ->minReviews(2);
    }

    //query to find the most popular book in the last 6 months
    public function scopePopularLast6Months(Builder $query): Builder|QueryBuilder
    {
        return $query->popular(now()->subMonths(6), now())
        ->highestRated(now()->subMonths(6), now())
        ->minReviews(5);
    }

    //query to find the most highest rated book in the last year
    public function scopeHighestRatedLastMonth(Builder $query): Builder|QueryBuilder
    {
        return $query->highestRated(now()->subMonth(), now())
        ->popular(now()->subMonth(), now())
        ->minReviews(2);
    }

    //query to find the most highest rated book in the last 6 months
    public function scopeHighestRatedLast6Months(Builder $query): Builder|QueryBuilder
    {
        return $query->highestRated(now()->subMonths(6), now())
        ->popular(now()->subMonths(6), now())
        ->minReviews(5);
    }

    // query to find the book with the minimum reviews
    public function scopeMinReviews(Builder $query, int $minReviews): Builder|QueryBuilder
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }

    protected static function booted()
    {
        static::updated(
            fn(Book $book) => cache()->forget('books:' . $book->id)
        ); //this is the method to cache the data from the database when the data is updated
        static::deleted(
            fn(Book $book) => cache()->forget('books:' . $book->id)
        ); //this is the method to cache the data from the database when the data is deleted
    }
}