<x-guest-layout>
    <div class="text-center py-6">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Liste des articles publiés de {{ $user->name }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        @if($articles->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    Cet utilisateur n'a pas encore publié d'article.
                </div>
            </div>
        @else
            <div class="flex flex-col gap-6">
                <!-- Articles -->
                @foreach ($articles as $article)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-bold mb-2">{{ $article->title }}</h3>
                        
                        <!-- Badge Catégories -->
                        @if($article->categories->count() > 0)
                            <div class="mb-4 flex gap-2">
                                @foreach($article->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <p class="text-gray-700 mb-4">{{ substr($article->content, 0, 150) }}...</p>
                        
                        <div class="text-right">
                            <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="text-blue-500 hover:text-blue-700 font-semibold">Lire la suite &rarr;</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</x-guest-layout>
