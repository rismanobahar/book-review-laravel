<?php

namespace App\Models;

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
}
