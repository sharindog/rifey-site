<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class PhotoCategory extends Model
{
    use AsSource, Filterable, Attachable;

    protected $fillable = ['title'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
