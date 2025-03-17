@extends('layouts.app')

@section('content')
<h1 class="mb-10 text-2xl">Books</h1>

<!-- Search Feature -->
<form method="GET" action="{{ route('books.index') }}" class="mb-4 flex items-center space-x-2">
    <input type="text" name="title" placeholder="Search by Title"
    value="{{ request('title') }}" class="input h-10"/>
    <input type="hidden" name="filter" value="{{ request('filter') }}"/>
    <button type="submit" class="btn h-10">Search</button>
    <a href="{{ route('books.index') }}" class="btn h-10">Clear</a>
</form>

<!-- Filter Feature -->
<div class="filter-container mb-4 flex">
    <!-- the list of books based on the selected filter. -->
    @php
    $filters = [
        '' => 'Latest',
        'popular_last_month' => 'Popular Last Month',
        'popular_last_6months' => 'Popular Last 6 Months',
        'highest_rated_last_month' => 'Highest Rated Last Month',
        'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
    ];
    @endphp

    <!-- configure the filter feature to display the list of books based on the selected filter.  -->
    @foreach ($filters as $key => $label)
    <!-- 1. the href attribute is used as a route for displaying each filter. the '...request()->query()' code will retain 
     the view if the user changing the search and filter constantly. the ''filter' => $key' code will select every
     filter that is aliased as $key -->
    <!-- 2. the class attribute will be showing every filter that is selected and applying the CSS. the 
     '(request('filter') === null && $key === ' code will applying CSS for the null(latest) filter otherwise 
     it will apply view to the other filters-->
        <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"  
           class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
           {{ $label }}
        </a>
    @endforeach
</div>

<!-- Book List -->
<ul>
    @forelse ($books as $book)
    <li class="mb-4">
        <div class="book-item">
            <div
                class="flex flex-wrap items-center justify-between">
                <div class="w-full flex-grow sm:w-auto">
                    <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                    <span class="book-author">by {{ $book->author }}</span>
                </div>
                <div>
                    <div class="book-rating">
                        {{ number_format($book->reviews_avg_rating, 1) }} <!-- 1 mean the decimal is 1, e.g 1.0 -->
                    </div>
                    <div class="book-review-count">
                        out of {{ $book->reviews_count }} {{ Str::plural('review', 2) }} 
                    </div>  
                </div>
            </div>
        </div>
    </li>
    <!-- If the book list is empty, this will be shown -->
    @empty
    <li class="mb-4">
        <div class="empty-book-item">
            <p class="empty-text">No books found</p>
            <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
        </div>
    </li>
    @endforelse
</ul>
@endsection