<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class AuthorService
{
    public function getAllAuthors($perPage = 10)
    {
        return Cache::remember('all_authors', 3600, function () use ($perPage) {
            return Author::with('books')->paginate($perPage);
        });
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
