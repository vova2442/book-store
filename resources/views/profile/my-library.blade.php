<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Моя библиотека</h2>
                    
                    {{-- Сообщения об успехе/ошибке --}}
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                         <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($myBooks->isEmpty())
                        <p>У вас пока нет купленных или арендованных книг.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($myBooks as $book)
                                <div class="border rounded-lg p-4 flex justify-between items-center">
                                    <div>
                                        <h3 class="font-bold text-lg">{{ $book->title }}</h3>
                                        <p class="text-sm text-gray-600">Автор: {{ $book->author }}</p>
                                    </div>
                                    <div>
                                        @if($book->pivot->type == 'purchase')
                                            <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">Куплена</span>
                                        @elseif($book->pivot->type == 'rent')
                                            <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                Арендована до {{ \Carbon\Carbon::parse($book->pivot->expires_at)->format('d.m.Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>