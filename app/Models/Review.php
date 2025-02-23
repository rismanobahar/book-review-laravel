<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'rating']; //ensuring these specific filed can be mass assigned

    public function book()
    {
        // this stating that this review model belong to the book model as one-to-one relationship
        return $this->belongsTo(Book::class);
    }
}
