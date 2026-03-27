<x-guest-layout>
    <div class="text-center py-10">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
            Bienvenue sur <span class="text-blue-600">Larablog</span>
        </h1>
        <p class="mt-4 text-xl text-gray-500">
            Découvrez les articles les plus populaires de notre plateforme.
        </p>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12">
        @if($articles->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center text-lg">
                    Aucun article n'a été publié pour le moment.
                </div>
            </div>
        @else
            <div class="grid gap-8 lg:grid-cols-2">
                @foreach ($articles as $article)
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 transition hover:shadow-xl">
                    <div class="p-6 text-gray-900 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-2xl font-bold flex-1">{{ $article->title }}</h3>
                            <span class="inline-flex items-center justify-center px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full ml-4 whitespace-nowrap">
                                ❤️ {{ $article->likes ?? 0 }} Like(s)
                            </span>
                        </div>
                        
                        <!-- Badge Catégories -->
                        @if($article->categories->count() > 0)
                            <div class="mb-4 flex flex-wrap gap-2">
                                @foreach($article->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <p class="text-gray-600 mb-6 flex-grow">{{ substr($article->content, 0, 150) }}...</p>
                        
                        <div class="text-sm text-gray-500 mb-4 border-t border-gray-100 pt-4">
                            Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}" class="text-blue-500 font-semibold hover:underline">{{ $article->user->name }}</a>
                        </div>
                        
                        <div class="text-right">
                            <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="inline-block bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold py-2 px-4 rounded transition">Lire la suite &rarr;</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</x-guest-layout>
