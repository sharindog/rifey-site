<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $t) {
            $t->id();
            $t->foreignId('photo_category_id')->constrained()->cascadeOnDelete();
            $t->unsignedInteger('attachment_id');
            $t->foreign('attachment_id')
                ->references('id')->on('attachments')
                ->cascadeOnDelete();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('photos'); }
};
