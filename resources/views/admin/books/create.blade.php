<x-admin-layout>
    <h1 class="text-2xl font-semibold mb-4">Добавить новую книгу</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        {{-- Если есть ошибки валидации, они будут показаны здесь --}}
        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Название -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <!-- Автор -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Автор</label>
                    <input type="text" name="author" id="author" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <!-- Категория -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Категория</label>
                    <input type="text" name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <!-- Год -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700">Год</label>
                    <input type="number" name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <!-- Цена -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Цена</label>
                    <input type="text" name="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                 <!-- Статус (по умолчанию available) -->
                <input type="hidden" name="status" value="available">

                <!-- Описание -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Сохранить</button>
                <a href="{{ route('admin.books.index') }}" class="text-gray-600 ml-4">Отмена</a>
            </div>
        </form>
    </div>
</x-admin-layout>