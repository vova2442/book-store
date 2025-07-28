<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - Bookstore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-200">
        <!-- Боковая панель -->
        <div class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="px-6 py-4 text-2xl font-bold">Админ-панель</div>
            <nav class="flex-grow">
                <a href="{{ route('admin.books.index') }}" class="block px-6 py-3 hover:bg-gray-700">Управление книгами</a>
                <a href="{{ route('books.index') }}" target="_blank" class="block px-6 py-3 hover:bg-gray-700">Перейти на сайт</a>
            </nav>
        </div>

        <!-- Основной контент -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4 flex justify-end">
                <span class="mr-4">Администратор: {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="underline">
                        Выход
                    </a>
                </form>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>