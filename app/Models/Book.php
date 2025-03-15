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

    //to query the reviews column and order the element by reviews_count in descendant order
    public function scopePopular(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withCount(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)]) //this is the separated cod
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
        return $query->withAvg(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)], 'rating')
        ->orderBy('reviews_avg_rating', 'desc');
    }

    // query to find the book with the minimum reviews
    public function scopeMinReviews(Builder $query, int $minReviews): Builder|QueryBuilder
    {
        return $query->having('reviews_count', '>=', $minReviews);
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

    public function scopePopularLastMonth(Builder $query): Builder|QueryBuilder
    {
        return $query->popular(now()->subMonth(), now())
        ->highestRated(now()->subMonth(), now())
        ->minReviews(2);
    }

    public function scopePopularLast6Months(Builder $query): Builder|QueryBuilder
    {
        return $query->popular(now()->subMonths(6), now())
        ->highestRated(now()->subMonths(6), now())
        ->minReviews(5);
    }

    public function scopePopularLastMonth(Builder $query): Builder|QueryBuilder
    {
        return $query->highestRated(now()->subMonth(), now())
        ->popular(now()->subMonth(), now())
        ->minReviews(2);
    }

    public function scopePopularLast6Months(Builder $query): Builder|QueryBuilder
    {
        return $query->highestRated(now()->subMonths(6), now())
        ->popular(now()->subMonths(6), now())
        ->minReviews(5);
    }
}