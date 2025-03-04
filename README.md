## DESCRIPTION :
This is a project about book review where there will be some books with review as comments and rating.

## TECH STACK :
This project will using some stacks as follows:
- laravel = 10.48.28
- PHP = 8.1.10
- database = mySQL
- frontend = laravel blade
- composer = 2.8.1
- containerization = Docker

## Installation Steps :
git clone https://github.com/rismanobahar/book-review-laravel.git
cd book-review
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

## command line list detail :
- composer create-project --prefer-dist laravel/laravel book-review = create the book-review project
- code . = to open the project folder separately
- php artisan make:model Book -m = to make a model file and migration file for book
- php artisan make:model Review -m = to make a model file and migration file for Review
- php artisan migrate = to migrate the database table that has been defined in the migration file before
- php artisan make:factory BookFactory --model=Book = make a dummy data for book table
- php artisan make:factory ReviewFactory --model=Review = make a dummy data for review table
- php artisan migrate:refresh --seed = to insert the dummy data into database
- php artisan tinker = run powershell in CLI
-  TINKER - $books = \App\Models\Book::with('reviews')->find(1); = to create a variable called boon and then find certain book and review                 
-  TINKER - $review = $book->reviews; = create a variable name $review and then find all the books review
-  TINKER - $book = \App\Models\Book::find(1); = find the first book
-  TINKER - $books = \App\Models\Book::with('reviews')->take(3)->get(); = find the first 3 books and reviews
-  TINKER - $book->load('reviews'); = to load the reviews data
-  TINKER - $review = new \App\Models\Review(); = create new object that is review
-  TINKER - $review->review = 'This was fine'; = defining this String into database
-  TINKER - $review->rating = 3; = defining this number into database
-  TINKER - $book->reviews()->save($review); = inserting the data into database
-  TINKER - $review = $book->reviews()->create(['review' => 'Sample review', 'rating' => 5]); = insert the review and rating object after making these column fillable in the model
- TINKER - $review = \App\Models\Review::find(1); = find review in id 1
- TINKER - $review->book; = find the book column via review properties 
- TINKER - $book2 = \App\Models\Book:find(2); = create a variable $book2 and find the second row book data
- TINKER - $book2->reviews()->save($review); = save the review data from id 1(first row of column) and connect it with the book data
- TINKER - $review = \App\Models\Review::with('book')->find(1); = find the book and review in the first row data
- TINKER - \App\Models\Book::where('title', 'LIKE', '%qui%')->get(); = to find particular title column with the 'LIKE' operator and the word 'qui' from - database 
- TINKER - \App\Models\Book::title('delectus')->get(); = a simpler way compared to the previous command after adding particular code in the model
- TINKER - \App\Models\Book::title('delectus')->where('created_at', '>', '2023-01-01')->get(); = find the particular data where it was created from -3-01-01
- TINKER - \App\Models\Book::title('delectus')->where('created_at', '>', '2023-01-01')->toSql; = convert the ORM query into sql query
- TINKER - \App\Models\Book::withCount('reviews')->get(); = add a new table column to count reviews in each data
- TINKER - \App\Models\Book::withCount('reviews')->latest()->limit(3)->get(); = only show the top 3 recent data
- TINKER - \App\Models\Book::limit(5)->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating')->get(); = to get the average rating of reviews for -h book with limit 5 data with the column name : reviews_avg_rating
- TINKER - \App\Models\Book::limit(5)->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating')->toSql(); = to generate Sql query with limit 5 data
- TINKER - \App\Models\Book::withCount('reviews')->withAvg('reviews', 'rating')->having('reviews_count', '>=', 10)->orderBy('reviews_avg_rating', 'desc')->limit(10)->get(); = count the reviews average that has the best rating and have at least 10 or more reviews with such amount in descending sort and limit the display in 10
- TINKER - \App\Models\Book::withCount('reviews')->withAvg('reviews', 'rating')->having('reviews_count', '>=', 10)->orderBy('reviews_avg_rating', 'desc')->limit(10)->toSql(); = convert the code above into Sql query 
- TINKER - \App\Models\Book::popular()->highestRated()->get(); = to list the most popular book based on reviews and rating

## folder list detail : 
- **app/Models**: Represents a table in the database and provides an interface to interact with it. It contains business logic and relationships 
- database/migrations = Defines the structure of a database table (columns, types, constraints). It is used to create, modify, or delete tables
- database/factories = defining/generating model dummy data
- database/seeders = generate dummy data into the database

## file list detail :
- .env = configuring database and connection
- database/migrations/create_books_table.php = define the db structure for books table
- database/migrations/create_reviews_table.php = define the db structure for review table
- app/Models/Book.php = creating interface to interact with book table
- app/Models/Review.php = creating interface to interact with review table
- database/factories/BookFactory.php = generate and define the model of dummy data on book table
- database/factories/ReviewFactory.php = generate and define the model of dummy data on review table