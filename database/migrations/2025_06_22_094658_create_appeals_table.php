<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appeals', function (Blueprint $t) {
            $t->id();

            $t->enum('category', ['individual', 'company']);

            $t->enum('topic', [
                'contract',        // заключение договора
                'coop_offer',      // предложение о сотрудничестве
                'buy_recyclables', // купить вторсырьё
                'no_collection',   // невывоз мусора
                'landfill',        // сообщение о свалке
                'tariff_question', // вопрос по стоимости
                'billing_question',// вопрос по счетам
                'other',
            ]);

            $t->string('settlement', 120);
            $t->text('body');

            $t->string('fio', 150)->nullable();

            $t->string('inn', 12)->nullable();
            $t->string('contact_name', 150)->nullable();

            $t->string('email');
            $t->string('phone', 30);

            $t->boolean('is_repeat')->default(false);
            $t->string('prev_number', 30)->nullable();

            $t->enum('status', ['new','in_work','answered','closed'])->default('new');

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appeals');
    }
};
