<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $t) {
            $t->id();
            $t->foreignId('video_category_id')->constrained()->cascadeOnDelete();
            $t->string('title');
            $t->string('youtube_url');
            $t->date('published_at')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('videos'); }
};
