<x-admin-layout>
    <h1 class="text-2xl font-semibold mb-4">Управление книгами</h1>

    {{-- Сообщение об успехе --}}
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('admin.books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Добавить новую книгу
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm text-left">Название</th>
                    <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm text-left">Автор</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Цена</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Статус</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Действия</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($books as $book)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $book->title }}</td>
                    <td class="py-3 px-4">{{ $book->author }}</td>
                    <td class="py-3 px-4">{{ number_format($book->price, 2, ',', ' ') }} ₽</td>
                    <td class="py-3 px-4">{{ $book->status }}</td>
                    <td class="py-3 px-4 text-center">
                        <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Редактировать</a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline-block" onsubmit="return confirm('Вы уверены, что хотите удалить эту книгу?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>