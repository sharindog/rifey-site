<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->latest('published_at')->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        if (!$news->is_published) {
            abort(404);
        }

        return view('news.show', compact('news'));
    }
}

