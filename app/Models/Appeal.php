<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Appeal extends Model
{
    use AsSource, Attachable;

    protected $guarded = [];

    /* связь с вложениями */
    public function attachments()
    {
        return $this->morphToMany(Attachment::class, 'attachmentable', 'attachmentable');
    }

    /* ───── Аксессор читаемой категории ───── */
    public function getCategoryReadableAttribute(): string
    {
        return $this->category === 'individual'
            ? 'Физ. лицо'
            : 'Юр. лицо';
    }

    /* ─── доступные для mass-assign ──────────────────────────────── */
    protected $fillable = [
        'category',       // individual | company
        'topic',          // enum темы
        'settlement',
        'body',

        // individual
        'fio',

        // company
        'inn',
        'contact_name',

        // common contact
        'email',
        'phone',

        // повторное обращение
        'is_repeat',
        'prev_number',

        // служебные
        'status',
    ];

    /* ─── преобразования ───────────────────────────────────────────*/
    protected $casts = [
        'is_repeat' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* ─── готовые scope’ы для фильтрации (пример) ───────────────── */
    public function scopeNew($q)      { return $q->where('status', 'new');      }
    public function scopeInWork($q)   { return $q->where('status', 'in_work');  }
    public function scopeAnswered($q) { return $q->where('status', 'answered'); }
    public function scopeClosed($q)   { return $q->where('status', 'closed');   }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(AppealStatusLog::class);
    }

    public function files(): MorphToMany
    {
        return $this
            ->attachments()
            ->wherePivot('group', 'files');
    }

}
