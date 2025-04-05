<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            // comment the book_id table on the below code for the simplified code
            $table->unsignedBigInteger('book_id'); // Foreign key to the books table
            $table->text('review'); // Review text
            $table->unsignedTinyInteger('rating'); // Rating (1-5)
            $table->timestamps(); // Created at and updated at timestamps

            // create a relationship between code. book_id(foreign key), id(primary key), books(table), cascade(to delete the entire colum related with the deleted data)
            $table->foreign('book_id')->references('id')->on('books')
            ->onDelete('cascade'); // Delete reviews when the book is deleted

            // the following code help to simplify the code on the above code for creating table relationship
            // $table->foreignId('book_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
