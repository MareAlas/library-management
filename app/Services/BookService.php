<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class BookService
{
    public function getAllBooks($perPage=10)
    {
        return Cache::remember('all_books', 3600, function () use ($perPage) {
            return Book::with('authors')->paginate($perPage);
        });
    }

    public function getBookById($id)
    {
        return Book::find($id);
    }

    public function createBook($validatedData)
    {
        $book = Book::create($validatedData);
        $book->authors()->sync($validatedData['authors']);

        return $book;
    }

    public function updateBook($book, $validatedData)
    {
        $book->update($validatedData);
        $book->authors()->sync($validatedData['authors']);

        return $book;
    }

    public function deleteBook($book)
    {
        $book->delete();
    }

    public function searchBooks($title = null, $author = null, $published_year = null, $perPage = 10)
    {
        $query = Book::query();
    
        if ($title) {
            $query->where('title', 'like', '%' . $title . '%');
        }
    
        if ($author) {
            $query->whereHas('authors', function ($query) use ($author) {
                $query->where('name', 'like', '%' . $author . '%');
            });
        }

        if ($published_year) {
            $query->where('published_year', '=', $published_year);
        }
    
        return $query->paginate($perPage);
    }
}
