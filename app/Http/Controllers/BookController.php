<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    
    public function index()
    {
        $books = $this->bookService->getAllBooks();

        return response()->json($books, 200);
    }

    public function show($id)
    {
        $book = $this->bookService->getBookById($id);

        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book, 200);
    }

    public function store(StoreBookRequest $request)
    {
        $book = $this->bookService->createBook($request->validated());

        return response()->json($book, 201);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $book = $this->bookService->getBookById($id);

        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $updatedBook = $this->bookService->updateBook($book, $request->validated());

        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $book = $this->bookService->getBookById($id);

        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $this->bookService->deleteBook($book);

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $title = $request->input('title');
        $author = $request->input('author'); 
        $published_year = $request->input('published_year');
        $perPage = $request->input('perPage', 10);
    
        $books = $this->bookService->searchBooks($title, $author, $published_year, $perPage);
    
        return response()->json($books, 200);
    }
}
