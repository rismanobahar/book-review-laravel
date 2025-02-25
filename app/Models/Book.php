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
}
