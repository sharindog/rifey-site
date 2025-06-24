<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class VideoCategory extends Model
{
    use AsSource, Filterable;

    protected $fillable = ['title'];

    public function videos() { return $this->hasMany(Video::class); }
}
