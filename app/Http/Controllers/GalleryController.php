<?php
namespace App\Http\Controllers;

use App\Models\PhotoCategory;
use App\Models\VideoCategory;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function photos(): View
    {
        $categories = PhotoCategory::with('photos.attachment')->orderBy('title')->get();
        return view('gallery.photos', compact('categories'));
    }

    public function videos(): View
    {
        $categories = VideoCategory::with('videos')->orderBy('title')->get();
        return view('gallery.videos', compact('categories'));
    }
}
