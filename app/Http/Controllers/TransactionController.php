<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Для транзакций
use Carbon\Carbon; // Для работы с датами

class TransactionController extends Controller
{
    // Метод для покупки книги
    public function buy(Request $request)
    {
        $request->validate(['book_id' => 'required|exists:books,id']);
        $book = Book::findOrFail($request->book_id);

        // Проверяем, доступна ли книга
        if ($book->status !== 'available') {
            return back()->with('error', 'Эта книга уже недоступна.');
        }

        DB::transaction(function () use ($book) {
            // 1. Создаем запись в связующей таблице
            Auth::user()->books()->attach($book->id, [
                'type' => 'purchase',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Обновляем статус книги
            $book->status = 'purchased';
            $book->save();
        });

        return redirect()->route('my-library')->with('success', 'Книга "' . $book->title . '" успешно куплена!');
    }

    // Метод для аренды книги
    public function rent(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rent_period' => 'required|string',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->status !== 'available') {
            return back()->with('error', 'Эта книга уже недоступна.');
        }

        // Рассчитываем дату окончания аренды
        $expiresAt = null;
        switch ($request->rent_period) {
            case '2_weeks':
                $expiresAt = Carbon::now()->addWeeks(2);
                break;
            case '1_month':
                $expiresAt = Carbon::now()->addMonth();
                break;
            case '3_months':
                $expiresAt = Carbon::now()->addMonths(3);
                break;
            default:
                return back()->with('error', 'Неверный срок аренды.');
        }

        DB::transaction(function () use ($book, $expiresAt) {
            Auth::user()->books()->attach($book->id, [
                'type' => 'rent',
                'expires_at' => $expiresAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $book->status = 'rented';
            $book->save();
        });

        return redirect()->route('my-library')->with('success', 'Книга "' . $book->title . '" успешно арендована до ' . $expiresAt->format('d.m.Y'));
    }
}