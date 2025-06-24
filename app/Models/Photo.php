<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Models\Attachment;

class Photo extends Model
{
    use AsSource;

    protected $fillable = ['photo_category_id', 'attachment_id'];

    public function category() { return $this->belongsTo(PhotoCategory::class); }
    public function attachment() { return $this->belongsTo(Attachment::class); }
}
