<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_categories', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('video_categories'); }
};
