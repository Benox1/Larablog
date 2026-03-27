<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Valider la présence de l'ID de l'article et du contenu
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|string',
        ]);

        // Rediriger si non connecté (par sécurité, géré aussi par le middleware auth)
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Créer le commentaire
        Comment::create([
            'content' => $request->input('content'),
            'article_id' => $request->input('article_id'),
            'user_id' => Auth::user()->id
        ]);

        // Rediriger vers la page d'où vient l'utilisateur (la page de l'article)
        return redirect()->back();
    }
}
