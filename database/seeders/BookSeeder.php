<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Команду truncate отсюда мы убрали!
        
        DB::table('books')->insert([
            // ... здесь идет массив со всеми твоими книгами, он не меняется ...
            [
                'title' => 'Дюна',
                'author' => 'Фрэнк Герберт',
                'year' => 1965,
                'category' => 'Фантастика',
                'description' => 'Эпическая сага о борьбе за власть на пустынной планете Арракис.',
                'price' => 750.00,
                'status' => 'available',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'title' => 'Автостопом по галактике',
                'author' => 'Дуглас Адамс',
                'year' => 1979,
                'category' => 'Фантастика',
                'description' => 'Юмористическая история о приключениях Артура Дента после уничтожения Земли.',
                'price' => 450.00,
                'status' => 'available',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'title' => 'Убийство в «Восточном экспрессе»',
                'author' => 'Агата Кристи',
                'year' => 1934,
                'category' => 'Детектив',
                'description' => 'Эркюль Пуаро расследует загадочное убийство в застрявшем в снегу поезде.',
                'price' => 400.00,
                'status' => 'available',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'title' => 'Властелин колец: Братство Кольца',
                'author' => 'Дж. Р. Р. Толкин',
                'year' => 1954,
                'category' => 'Фэнтези',
                'description' => 'Начало эпического путешествия хоббита Фродо для уничтожения Кольца Всевластья.',
                'price' => 800.00,
                'status' => 'available',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'title' => 'Задача трёх тел',
                'author' => 'Лю Цысинь',
                'year' => 2008,
                'category' => 'Фантастика',
                'description' => 'Современная научная фантастика о первом контакте с инопланетной цивилизацией.',
                'price' => 900.00,
                'status' => 'available',
                'created_at' => now(), 'updated_at' => now()
            ]
        ]);
    }
}