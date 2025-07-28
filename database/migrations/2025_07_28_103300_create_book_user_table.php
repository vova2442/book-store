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
        Schema::create('book_user', function (Blueprint $table) {
            $table->id();
            // Связь с таблицей users. onDelete('cascade') удалит эту запись, если пользователь будет удален.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Связь с таблицей books.
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            // Тип операции: 'purchase' (покупка) или 'rent' (аренда)
            $table->string('type'); 
            
            // Дата окончания аренды (может быть NULL, если это покупка)
            $table->timestamp('expires_at')->nullable();

            $table->timestamps(); // created_at будет датой покупки/аренды
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_user');
    }
};