<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book; // Импортируем модель Book
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    /**
     * Показывает список всех книг в админ-панели. (READ)
     */
    public function index()
    {
        $books = Book::orderBy('title')->get();
        return view('admin.books.index', ['books' => $books]);
    }

    /**
     * Показывает форму для создания новой книги. (CREATE form)
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Сохраняет новую книгу в базе данных. (CREATE logic)
     */
    public function store(Request $request)
    {
        // Простая валидация данных из формы
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Book::create($validated);

        // Перенаправляем на страницу со списком книг с сообщением об успехе
        return redirect()->route('admin.books.index')->with('success', 'Книга успешно добавлена!');
    }

    /**
     * Показывает форму для редактирования книги. (UPDATE form)
     */
    public function edit(Book $book) // Используем Route Model Binding
    {
        return view('admin.books.edit', ['book' => $book]);
    }

    /**
     * Обновляет информацию о книге в базе данных. (UPDATE logic)
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string', // Добавляем статус для управления
        ]);

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена!');
    }

    /**
     * Удаляет книгу из базы данных. (DELETE)
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Книга успешно удалена!');
    }
}