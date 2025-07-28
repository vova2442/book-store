<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Уникальный идентификатор книги (Primary Key)
            $table->string('title'); // Название книги
            $table->string('author'); // Автор
            $table->integer('year'); // Год написания
            $table->string('category'); // Категория (например, "Фантастика", "Детектив")
            $table->text('description')->nullable(); // Описание книги (может быть пустым)
            $table->decimal('price', 8, 2); // Цена (8 цифр всего, 2 после запятой)
            $table->string('status')->default('available'); // Статус: 'available', 'rented', 'purchased'
            $table->timestamps(); // Поля created_at и updated_at (создаются автоматически)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};