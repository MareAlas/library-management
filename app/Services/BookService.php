<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function getAllBooks()
    {
        return Book::all();
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
}
