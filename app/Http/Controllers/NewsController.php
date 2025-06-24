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
        abort_unless($news->is_published, 404);
        return view('news.show', compact('news'));
    }
}

