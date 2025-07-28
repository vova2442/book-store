<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Импортируем DB
use Illuminate\Support\Facades\Schema; // Импортируем Schema
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Отключаем проверку внешних ключей
        Schema::disableForeignKeyConstraints();

        // 2. Очищаем таблицы. Порядок важен: сначала дочернюю, потом родительскую.
        // Хотя с отключенной проверкой это не так критично.
        DB::table('book_user')->truncate();
        DB::table('books')->truncate();
        DB::table('users')->truncate();

        // 3. Включаем проверку обратно! ЭТО ОЧЕНЬ ВАЖНО.
        Schema::enableForeignKeyConstraints();

        // 4. Теперь вызываем наши сидеры для заполнения
        $this->call([
            BookSeeder::class,
        ]);

        // Создаем администратора. Можешь раскомментировать, если передумаешь.
        User::create([
            'name' => 'Admin',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}