<x-app-layout>
    {{-- Шапка с названием (для этого контента она не нужна, так как есть в nav) --}}

    {{-- Основной контент --}}
    <div class="container mx-auto px-4 py-8">
        
        {{-- Блок с фильтрами --}}
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Фильтры и сортировка</h2>
            <form action="{{ route('books.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                
                {{-- Фильтр по категории --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Категория</label>
                    <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Все категории</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Фильтр по автору --}}
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Автор</label>
                    <select name="author" id="author" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Все авторы</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author }}" {{ request('author') == $author ? 'selected' : '' }}>
                                {{ $author }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Сортировка по году --}}
                <div>
                    <label for="sort_by" class="block text-sm font-medium text-gray-700">Сортировать по году</label>
                    <select name="sort_by" id="sort_by" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">По умолчанию</option>
                        <option value="year_desc" {{ request('sort_by') == 'year_desc' ? 'selected' : '' }}>Сначала новые</option>
                        <option value="year_asc" {{ request('sort_by') == 'year_asc' ? 'selected' : '' }}>Сначала старые</option>
                    </select>
                </div>

                {{-- Кнопки --}}
                <div class="flex space-x-2">
                    <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-lg hover:bg-indigo-600 transition duration-200">
                        Применить
                    </button>
                    <a href="{{ route('books.index') }}" class="w-full text-center bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-200">
                        Сбросить
                    </a>
                </div>

            </form>
        </div>

        <h2 class="text-2xl font-semibold mb-6">Каталог книг</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @if($books->isEmpty())
                <p class="col-span-full">Книги по вашему запросу не найдены. Попробуйте изменить фильтры.</p>
            @else
                @foreach ($books as $book)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                        <div class="bg-gray-200 h-48 w-full flex items-center justify-center">
                            <span class="text-gray-500">Изображение книги</span>
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold mb-2">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600 mb-1"><strong>Автор:</strong> {{ $book->author }}</p>
                            <p class="text-sm text-gray-600 mb-4"><strong>Категория:</strong> {{ $book->category }} ({{ $book->year }})</p>
                            <p class="text-gray-700 text-sm mb-4 flex-grow">{{ Str::limit($book->description, 100) }}</p>
                            <div class="mt-auto">
                                <p class="text-xl font-bold text-indigo-600 mb-3">{{ number_format($book->price, 2, ',', ' ') }} ₽</p>
                                <a href="{{ route('books.show', $book) }}" class="block text-center w-full bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600 transition duration-200">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>