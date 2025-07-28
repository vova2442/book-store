<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Отключаем проверку внешних ключей
        Schema::disableForeignKeyConstraints();

        // Очищаем таблицы. Порядок важен: сначала дочернюю, потом родительскую.
        DB::table('book_user')->truncate();
        DB::table('books')->truncate();
        DB::table('users')->truncate();

        Schema::enableForeignKeyConstraints();

        // Вызываем наши сидеры для заполнения
        $this->call([
            BookSeeder::class,
        ]);

        // Создаем обычного пользователя.
        User::create([
            'name' => 'User',
            'email' => 'userBookstore@com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
        // Создаем администратора.
        User::create([
            'name' => 'Admin',
            'email' => 'adminBookstore@com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}