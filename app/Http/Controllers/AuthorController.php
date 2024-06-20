<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Services\AuthorService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    
    public function index()
    {
        return response()->json($this->authorService->getAllAuthors(), 200);
    }

    public function show($id)
    {
        $author = $this->authorService->getAuthorById($id);

        if (is_null($author)) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json($author, 200);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = $this->authorService->createAuthor($request->validated());

        return response()->json($author, 201);
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $author = $this->authorService->getAuthorById($id);

        if (is_null($author)) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $updatedAuthor = $this->authorService->updateAuthor($author, $request->validated());

        return response()->json($author, 200);
    }

    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $author = $this->authorService->getAuthorById($id);

        if (is_null($author)) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $this->authorService->deleteAuthor($author);

        return response()->json(null, 204);
    }
}
