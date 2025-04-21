<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->isAbleTo('articles-read')) {
            abort(403, 'Unauthorized action.');
        }

        $articles = Article::with('user')->latest()->paginate(10);
        return view('tenant.articles.index', compact('articles'));
    }

    public function create()
    {
        if (!auth()->user()->isAbleTo('articles-create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('tenant.articles.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAbleTo('articles-create')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['status'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tenant.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        if (!auth()->user()->isAbleTo('articles-read')) {
            abort(403, 'Unauthorized action.');
        }

        return view('tenant.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        // Check if user is superadministrator or administrator
        if (auth()->user()->hasRole(['superadministrator', 'administrator'])) {
            if (!auth()->user()->isAbleTo('articles-update')) {
                abort(403, 'Unauthorized action.');
            }
        } else {
            // For other roles, they can only edit their own articles
            if ($article->user_id !== auth()->id()) {
                abort(403, 'You can only edit your own articles.');
            }
        }

        return view('tenant.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        // Check if user is superadministrator or administrator
        if (auth()->user()->hasRole(['superadministrator', 'administrator'])) {
            if (!auth()->user()->isAbleTo('articles-update')) {
                abort(403, 'Unauthorized action.');
            }
        } else {
            // For other roles, they can only update their own articles
            if ($article->user_id !== auth()->id()) {
                abort(403, 'You can only update your own articles.');
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $article->update($validated);

        return redirect()->route('tenant.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Check if user is superadministrator or administrator
        if (auth()->user()->hasRole(['superadministrator', 'administrator'])) {
            if (!auth()->user()->isAbleTo('articles-delete')) {
                abort(403, 'Unauthorized action.');
            }
        } else {
            // For other roles, they can only delete their own articles
            if ($article->user_id !== auth()->id()) {
                abort(403, 'You can only delete your own articles.');
            }
        }

        $article->delete();

        return redirect()->route('tenant.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
} 