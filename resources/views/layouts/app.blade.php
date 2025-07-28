<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Книжный магазин "Bookstore"</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <div class="min-h-screen">
        <!-- Основная навигация -->
        <nav class="bg-white border-b border-gray-100 shadow-md">
            <div class="container mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Логотип и ссылка на главную -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('books.index') }}" class="text-xl font-bold text-gray-900">
                                Bookstore
                            </a>
                        </div>
                    </div>

                    <!-- Ссылки для входа/регистрации или имя пользователя -->
                    <div class="flex items-center ml-6">
                        @guest
                            {{-- Если пользователь не вошел (гость) --}}
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline hover:text-gray-900">Вход</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline hover:text-gray-900">Регистрация</a>
                        @else
                            {{-- Если пользователь вошел --}}
                            {{-- Проверяем, является ли пользователь админом --}}
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.books.index') }}" class="mr-4 text-sm font-bold text-red-600 hover:text-red-800">Админ-панель</a>
                            @endif
                            <a href="{{ route('my-library') }}" class="mr-4 text-sm text-gray-700 underline hover:text-gray-900">Моя библиотека</a>
                            <span class="mr-4 text-sm text-gray-800">Привет, {{ Auth::user()->name }}!</span>
                            
                            {{-- Форма для выхода из системы --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-sm text-gray-700 underline hover:text-gray-900">
                                    Выход
                                </a>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Основной контент страницы -->
        <main>
            {{ $slot }}
        </main>

        <!-- Подвал сайта -->
        <footer class="bg-white mt-12 py-6">
            <div class="container mx-auto text-center text-gray-500">
                © {{ date('Y') }} Bookstore. Все права защищены.
            </div>
        </footer>
    </div>
</body>
</html>