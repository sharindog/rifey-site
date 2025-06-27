<?php

namespace App\Http\Controllers;


use App\Models\DocumentCategory;
use App\Models\PhotoCategory;
use App\Models\VideoCategory;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function about(): View
    {
        return view('about.index');
    }

    public function contacts(): View
    {
        return view('contacts');
    }

    public function documents()
    {
        $categories = DocumentCategory::with(['documents' => fn ($q) => $q->publicDocs()])
            ->where('title', 'not like', 'График вывоза ТКО:%')
            ->get();
        return view('about.docs', compact('categories'));
    }

    public function msk()
    {
        return view('about.msk');
    }

    public function ecohouse()
    {
        return view('about.ecohouse');
    }

    public function disclosure()
    {
        return view('about.disclosure');
    }
    public function activity()
    {
        return view('clients.activity');
    }
    public function contract()
    {
        return view('clients.contract');
    }
    public function schedule()
    {
        $groups = DocumentCategory::where('title', 'like', 'График вывоза ТКО:%')
            ->with('documents.attachment')
            ->orderBy('title')
            ->get()
            ->groupBy(fn ($cat) => Str::after($cat->title, 'График вывоза ТКО: '));

        return view('clients.schedule', compact('groups'));
    }
    public function photos(): View
    {
        $categories = PhotoCategory::with('photos.attachment')
            ->orderBy('title')
            ->get();

        return view('media.photos', compact('categories'));
    }

    public function videos(): View
    {
        $categories = VideoCategory::with('videos')
            ->orderBy('title')
            ->get();

        return view('media.videos', compact('categories'));
    }

    public function privacy(): View
    {
        return view('about.privacy');
    }
}
