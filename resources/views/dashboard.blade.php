<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message flash -->
            @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6 text-center">
                {{ session('error') }}
            </div>
            @endif

            <!-- Articles -->
            @foreach ($articles as $article)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 relative">
                    <div class="p-6 text-gray-900 border-b border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold">
                                    {{ $article->title }}
                                    @if($article->draft)
                                        <span class="text-sm bg-yellow-200 text-yellow-800 px-2 py-1 rounded ml-2 align-middle">Brouillon</span>
                                    @endif
                                </h2>
                                <p class="text-gray-700 mt-2">{{ substr($article->content, 0, 100) }}...</p>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-4">
                                <a href="{{ route('articles.edit', $article->id) }}" class="text-blue-500 hover:text-blue-700">Modifier</a>
                                
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </div>
                        </div>

                        <!-- Badge Catégories -->
                        @if($article->categories->count() > 0)
                            <div class="mt-4 flex gap-2">
                                @foreach($article->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach

            @if($articles->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 text-gray-900 text-center">
                        Vous n'avez pas encore d'article.
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
