<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book, 200);
    }

    public function store(Request $request)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'integer|exists:authors,id',
        ]);

        $book = Book::create($validatedData);
        $book->authors()->sync($request->authors);

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $book = Book::find($id);

        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'integer|exists:authors,id',
        ]);

        $book->update($validatedData);
        $book->authors()->sync($request->authors);

        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $book = Book::find($id);

        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(null, 204);
    }
}
