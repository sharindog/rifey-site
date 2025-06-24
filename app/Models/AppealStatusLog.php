<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;               // ← добавляем
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class AppealStatusLog extends Model
{
    use AsSource;                         // ← добавляем

    public $timestamps = false;

    protected $fillable = [
        'appeal_id',
        'user_id',
        'from_status',
        'to_status',
        'changed_at',
    ];

    /* автоматически превращаем в Carbon */
    protected $casts = [
        'changed_at' => 'datetime',
    ];

    /* связи */
    public function appeal(): BelongsTo  { return $this->belongsTo(Appeal::class); }
    public function user():   BelongsTo  { return $this->belongsTo(User::class);   }
}
