<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)->get();

        return view('dashboard', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'content', 'draft']);
        $data['user_id'] = Auth::user()->id;
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        $article = Article::create($data);

        if ($request->has('categories')) {
            $article->categories()->sync($request->input('categories'));
        }

        return redirect()->route('dashboard')->with('success', 'Article créé !');
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit d'accéder à cet article !");
        }

        $categories = Category::all();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit d'accéder à cet article !");
        }

        $data = $request->only(['title', 'content', 'draft']);
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        $article->update($data);

        if ($request->has('categories')) {
            $article->categories()->sync($request->input('categories'));
        }

        return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
    }

    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit de supprimer cet article !");
        }

        $article->delete();

        return redirect()->route('dashboard')->with('success', 'Article supprimé avec succès !');
    }

    public function like(Article $article)
    {
        $article->increment('likes');
        return redirect()->back();
    }
}
