
## command line list detail :
1. composer create-project --prefer-dist laravel/laravel book-review = create the book-review project
2. code . = to open the project folder separately
3. php artisan make:model Book -m = to make a model file and migration file for book
4. php artisan make:model Review -m = to make a model file and migration file for Review
5. php artisan migrate = to migrate the database table that has been defined in the migration file before
6. php artisan make:factory BookFactory --model=Book = make a dummy data for book table
7. php artisan make:factory ReviewFactory --model=Review = make a dummy data for review table
8. php artisan migrate:refresh --seed = to insert the dummy data into database
9. php artisan tinker = run powershell in CLI
10. TINKER - $books = \App\Models\Book::with('reviews')->find(1); = to find certain book and review                 
11. TINKER - $review = $book->reviews; = find all the books review
12. TINKER - $book = \App\Models\Book::find(1); = find the first book
13. TINKER - $books = \App\Models\Book::with('reviews')->take(3)->get(); = find the first 3 books and reviews
14. TINKER - $book->load('reviews');

## folder list detail : 
1. app/Models = Represents a table in the database and provides an interface to interact with it. It contains business logic and relationships 
2. database/migrations = Defines the structure of a database table (columns, types, constraints). It is used to create, modify, or delete tables
3. database/factories = defining/generating model dummy data
4. database/seeders = generate dummy data into the database

## file list detail :
1. .env = configuring database and connection
2. database/migrations/create_books_table.php = define the db structure for books table
3. database/migrations/create_reviews_table.php = define the db structure for review table
4. app/Models/Book.php = creating interface to interact with book table
5. app/Models/Review.php = creating interface to interact with review table
6. database/factories/BookFactory.php = generate and define the model of dummy data on book table
7. database/factories/ReviewFactory.php = generate and define the model of dummy data on review table