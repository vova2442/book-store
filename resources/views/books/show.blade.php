<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 md:flex">
                <!-- Условное изображение -->
                <div class="md:w-1/3 h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                    <span class="text-gray-500">Изображение книги</span>
                </div>

                <!-- Информация о книге -->
                <div class="md:w-2/3 md:pl-8 mt-6 md:mt-0">
                    <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-gray-700 mb-4"><strong>Автор:</strong> {{ $book->author }}</p>
                    <p class="text-gray-600 mb-4"><strong>Категория:</strong> {{ $book->category }} ({{ $book->year }})</p>
                    <p class="text-gray-800 mb-6">{{ $book->description }}</p>

                    <div class="border-t pt-6">
                        {{-- Проверяем, доступна ли книга --}}
                        @if($book->status === 'available')
                            {{-- Блок покупки --}}
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Купить книгу</h3>
                                <p class="text-2xl font-bold text-indigo-600 mb-3">{{ number_format($book->price, 2, ',', ' ') }} ₽</p>
                                <form action="{{ route('transactions.buy') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600">Купить</button>
                                </form>
                            </div>

                            {{-- Блок аренды --}}
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Арендовать книгу</h3>
                                <form action="{{ route('transactions.rent') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <div class="mb-3">
                                        <label for="rent_period" class="block text-sm font-medium text-gray-700">Выберите срок аренды:</label>
                                        <select name="rent_period" id="rent_period" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="2_weeks">2 недели - {{ number_format($book->price * 0.1, 2, ',', ' ') }} ₽</option>
                                            <option value="1_month">1 месяц - {{ number_format($book->price * 0.15, 2, ',', ' ') }} ₽</option>
                                            <option value="3_months">3 месяца - {{ number_format($book->price * 0.3, 2, ',', ' ') }} ₽</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">Арендовать</button>
                                </form>
                            </div>
                        @else
                            {{-- Если книга не доступна --}}
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                                <p class="font-bold">Книга недоступна</p>
                                <p>В данный момент эта книга уже куплена или арендована.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>