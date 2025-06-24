<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;   // ← добавили

class Video extends Model
{
    use AsSource, Filterable;    // ← включили трейт

    protected $fillable = ['video_category_id', 'title', 'youtube_url', 'published_at'];

    /* поля, которые разрешено фильтровать и сортировать в TD */
    protected array $allowedFilters = [
        'title',
        'video_category_id',
    ];

    protected array $allowedSorts   = [
        'id',
        'title',
        'published_at',
        'video_category_id',
    ];

    protected $casts = ['published_at' => 'date'];

    public function category() { return $this->belongsTo(VideoCategory::class); }

    public function youtubeId(): string
    {
        return preg_replace('~^.+v=|^.+be/~', '', $this->youtube_url);
    }
}
