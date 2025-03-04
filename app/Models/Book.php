<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
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
    public function scopePopular(Builder $query): Builder
    {
        return $query->withCount('reviews')
        ->orderBy('reviews_count', 'desc');
    }

    // to query the reviews and rating to find the average rating in descendant order
    public function scopeHighestRated(Builder $query): Builder
    {
        return $query->withAvg('reviews', 'rating')
        ->orderBy('reviews_avg_rating', 'desc');
    }
}
