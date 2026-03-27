<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        // Bonus (Étape 9) : Articles les plus likés sur la page d'accueil
        $articles = Article::where('draft', 0)->orderBy('likes', 'desc')->get();
        return view('welcome', compact('articles'));
    }

    public function index(User $user)
    {
        // Liste des articles publiés d'un utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->get();

        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }

    public function show(User $user, Article $article)
    {
        // Vérifier que l'article appartient bien à l'utilisateur
        if ($article->user_id !== $user->id) {
            abort(404);
        }

        // Vérifier que l'article est publié
        if ($article->draft) {
            abort(403, "Cet article n'est pas encore publié.");
        }

        return view('public.show', [
            'article' => $article
        ]);
    }
}
