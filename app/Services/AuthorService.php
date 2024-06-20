<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    public function getAllAuthors()
    {
        return Author::all();
    }

    public function getAuthorById($id)
    {
        return Author::find($id);
    }

    public function createAuthor($validatedData)
    {
        return Author::create($validatedData);
    }

    public function updateAuthor($author, $validatedData)
    {
        $author->update($validatedData);

        return $author;
    }

    public function deleteAuthor($author)
    {
        $author->delete();
    }
}
