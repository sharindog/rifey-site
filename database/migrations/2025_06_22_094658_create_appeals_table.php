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

            // категория заявителя
            $t->enum('category', ['individual', 'company']);

            // тема обращения
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
            $t->text('body');               // ≤500 символов контролируем на уровне валидации

            // поля для физического лица
            $t->string('fio', 150)->nullable();

            // поля для юрлица
            $t->string('inn', 12)->nullable();
            $t->string('contact_name', 150)->nullable();

            // общий контакт
            $t->string('email');
            $t->string('phone', 30);

            // повторное обращение
            $t->boolean('is_repeat')->default(false);
            $t->string('prev_number', 30)->nullable();

            // служебные поля
            $t->enum('status', ['new','in_work','answered','closed'])->default('new');
            $t->foreignId('operator_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $t->text('answer')->nullable();

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
