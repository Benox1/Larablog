<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un article
        </h2>
    </x-slot>

    <!-- Message flash -->
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{ session('success') }}
    </div>
    @endif

    <form method="post" action="{{ route('articles.store') }}" class="py-12">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                   <!-- Input de titre de l'article -->
                   <input type="text" name="title" id="title" placeholder="Titre de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div class="p-6 pt-0 text-gray-900 ">
                   <!-- Contenu de l'article -->
                   <textarea rows="10" name="content" id="content" placeholder="Contenu de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>

                <!-- Catégories -->
                <div class="p-6 pt-0 text-gray-900">
                    <h3 class="font-semibold mb-2">Catégories</h3>
                    <div class="flex flex-wrap gap-4">
                        @foreach($categories as $category)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 text-gray-900 flex items-center">
                    <!-- Action sur le formulaire -->
                    <div class="grow">
                        <input type="checkbox" name="draft" id="draft" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <label for="draft">Article en brouillon</label>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Créer l'article
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
