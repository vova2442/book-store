<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }
        if ($request->filled('author')) {
            $query->where('author', $request->input('author'));
        }
        if ($request->filled('sort_by')) {
            $sortBy = $request->input('sort_by');
            if ($sortBy == 'year_desc') {
                $query->orderBy('year', 'desc');
            } elseif ($sortBy == 'year_asc') {
                $query->orderBy('year', 'asc');
            }
        } else {
            $query->orderBy('title', 'asc');
        }
        $books = $query->get();
        $categories = Book::select('category')->distinct()->orderBy('category')->pluck('category');
        $authors = Book::select('author')->distinct()->orderBy('author')->pluck('author');

        return view('books.index', [
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }

    /**
     * Отображает страницу с детальной информацией о книге.
     */
    public function show(Book $book) // Используем Route Model Binding
    {
        return view('books.show', ['book' => $book]);
    }
}