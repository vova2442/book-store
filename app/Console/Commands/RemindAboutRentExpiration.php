<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log; // Для записи в лог-файл
use Illuminate\Support\Facades\DB;  // Для прямого запроса к БД
use Carbon\Carbon; // Для работы с датами

class RemindAboutRentExpiration extends Command
{
    /**
     * Имя и подпись консольной команды.
     * Это имя мы будем использовать для вызова команды: php artisan app:remind-about-rent-expiration
     * @var string
     */
    protected $signature = 'app:remind-about-rent-expiration';

    /**
     * Описание консольной команды.
     * @var string
     */
    protected $description = 'Finds expiring book rentals and sends reminders (logs them).';

    /**
     * Выполнение логики команды.
     */
    public function handle()
    {
        $this->info('Проверка сроков аренды...');

        // Ищем аренды, которые истекают завтра
        $tomorrow = Carbon::now()->addDay()->toDateString();

        $expiringRents = DB::table('book_user')
            ->join('users', 'book_user.user_id', '=', 'users.id')
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->where('book_user.type', 'rent')
            ->whereDate('book_user.expires_at', $tomorrow)
            ->select('users.name as user_name', 'users.email as user_email', 'books.title as book_title')
            ->get();
        
        if ($expiringRents->isEmpty()) {
            $this->info('Нет аренд, истекающих завтра. Задача завершена.');
            return;
        }

        $this->info('Найдено аренд для напоминания: ' . $expiringRents->count());

        foreach ($expiringRents as $rent) {
            // Формируем сообщение
            $message = sprintf(
                'НАПОМИНАНИЕ: Уважаемый %s! Срок аренды книги "%s" истекает завтра. Пожалуйста, не забудьте ее вернуть.',
                $rent->user_name,
                $rent->book_title
            );
            
            // Выводим в консоль для наглядности
            $this->line($message);

            // Записываем в лог-файл (симуляция отправки email)
            // Логи можно найти в файле /storage/logs/laravel.log
            Log::info($message . ' (Email: ' . $rent->user_email . ')');
        }

        $this->info('Все напоминания успешно отправлены (записаны в лог).');

        return self::SUCCESS;
    }
}