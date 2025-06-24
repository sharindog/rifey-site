<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $fillable = [
        'document_category_id',
        'title',
        'file',
    ];

    // связи
    public function category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id', 'id');
    }

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'file');
    }

    protected $allowedFilters = [
        'title',
        'category.title',
    ];

    protected $allowedSorts = [
        'id',
        'title',
        'created_at',
    ];

    public function scopeSchedules($q)
    {
        return $q->whereHas('category', function ($c) {
            $c->where('title', 'like', 'График вывоза ТКО:%');
        });
    }

    public function scopePublicDocs($q)
    {
        return $q->whereHas('category', function ($c) {
            $c->where('title', 'not like', 'График вывоза ТКО:%');
        });
    }
}
