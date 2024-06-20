<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

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

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        $book->authors()->sync($request->authors);

        return response()->json($book, 201);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);

        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->validated());
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
