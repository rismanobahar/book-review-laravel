
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
10. TINKER - $books = \App\Models\Book::with('reviews')->find(1); = to create a variable called boon and then find certain book and review                 
11. TINKER - $review = $book->reviews; = create a variable name $review and then find all the books review
12. TINKER - $book = \App\Models\Book::find(1); = find the first book
13. TINKER - $books = \App\Models\Book::with('reviews')->take(3)->get(); = find the first 3 books and reviews
14. TINKER - $book->load('reviews'); = to load the reviews data
15. TINKER - $review = new \App\Models\Review(); = create new object that is review
16. TINKER - $review->review = 'This was fine'; = defining this String into database
17. TINKER - $review->rating = 3; = defining this number into database
18. TINKER - $book->reviews()->save($review); = inserting the data into database
19. TINKER - $review = $book->reviews()->create(['review' => 'Sample review', 'rating' => 5]); = insert the review and rating object after making these column fillable in the model
20. TINKER - $review = \App\Models\Review::find(1); = find review in id 1
21. TINKER - $review->book; = find the book column via review properties 
22. TINKER - $book2 = \App\Models\Book:find(2); = create a variable $book2 and find the second row book data
23. TINKER - $book2->reviews()->save($review); = save the review data from id 1(first row of column) and connect it with the book data
24. TINKER - $review = \App\Models\Review::with('book')->find(1); = find the book and review in the first row data
25. TINKER - \App\Models\Book::where('title', 'LIKE', '%qui%')->get(); = to find particular title column with the 'LIKE' operator and the word 'qui' from the database 
26. TINKER - \App\Models\Book::title('delectus')->get(); = a simpler way compared to the previous command after adding particular code in the model
27. TINKER - \App\Models\Book::title('delectus')->where('created_at', '>', '2023-01-01')->get(); = find the particular data where it was created from 2023-01-01
28. TINKER - \App\Models\Book::title('delectus')->where('created_at', '>', '2023-01-01')->toSql; = convert the ORM query into sql query
29. TINKER - \App\Models\Book::withCount('reviews')->get(); = add a new table column to count reviews in each data
30. TINKER - \App\Models\Book::withCount('reviews')->latest()->limit(3)->get(); = only show the top 3 recent data
31. TINKER - \App\Models\Book::limit(5)->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating')->get(); = to get the average rating of reviews for each book with limit 5 data with the column name : reviews_avg_rating
32. TINKER - \App\Models\Book::limit(5)->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating')->toSql(); = to generate Sql query with limit 5 data
33. TINKER - \App\Models\Book::withCount('reviews')->withAvg('reviews', 'rating')->having('reviews_count', '>=', 10)->orderBy('reviews_avg_rating', 'desc')->limit(10)->get(); = count the reviews average that has the best rating and have at least 10 or more reviews with such amount in descending sort and limit the display in 10
34. TINKER - \App\Models\Book::withCount('reviews')->withAvg('reviews', 'rating')->having('reviews_count', '>=', 10)->orderBy('reviews_avg_rating', 'desc')->limit(10)->toSql(); = convert the code above into Sql query 

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