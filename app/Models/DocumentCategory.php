<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class DocumentCategory extends Model
{
    use HasFactory, AsSource;
    protected $fillable = ['title'];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}

