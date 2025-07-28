<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Маршруты для всех пользователей ---
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// --- Маршруты, требующие аутентификации ---
Route::middleware('auth')->group(function () {
    // Маршруты для покупки и аренды
    Route::post('/buy', [TransactionController::class, 'buy'])->name('transactions.buy');
    Route::post('/rent', [TransactionController::class, 'rent'])->name('transactions.rent');

    // Маршрут для библиотеки пользователя
    Route::get('/my-library', [ProfileController::class, 'myLibrary'])->name('my-library');
    
    // Маршруты для профиля от Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- Маршруты только для администраторов ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('books', AdminBookController::class);
});


// --- Стандартные маршруты от Breeze ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';