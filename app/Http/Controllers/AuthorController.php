<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

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

    public function store(Request $request)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ]);

        $author = Author::create($validatedData);

        return response()->json($author, 201);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $author = Author::find($id);

        if (is_null($author)) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ]);

        $author->update($validatedData);

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
