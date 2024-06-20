<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json(Author::all(), 200);
    }

    public function show($id)
    {
        $author = Author::find($id);

        if (is_null($author)) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json($author, 200);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return response()->json($author, 201);
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $author = Author::find($id);

        if (is_null($author)) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->update($request->validated());

        return response()->json($author, 200);
    }

    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $author = Author::find($id);

        if (is_null($author)) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->delete();

        return response()->json(null, 204);
    }
}
