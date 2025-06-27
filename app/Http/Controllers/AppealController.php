<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppealRequest;
use App\Models\Appeal;
use App\Mail\AppealCreated;
use Illuminate\Support\Facades\Mail;
use Orchid\Attachment\File;       // Orchid-класс для загрузки
use Illuminate\Http\Request;

class AppealController extends Controller
{
    /**
     * Показывает форму создания обращения.
     */
    public function create()
    {
        // Если ваш Blade лежит в resources/views/appeal/create.blade.php:
        return view('appeal.create');
    }

    /**
     * Обрабатывает POST-запрос и сохраняет новое обращение.
     */
    public function store(AppealRequest $request)
    {
        // 1) Сохраняем данные из формы в БД
        $data   = $request->validated();
        $appeal = Appeal::create($data);

        // 2) Загружаем файлы в Orchid и «пришиваем» их к модели
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                $attachment = (new File($uploadedFile))
                    ->path("appeals/{$appeal->id}")  // опционально: свой путь
                    ->load();                       // сохраняет в disk и в таблицу attachments

                // привязываем attachment к модели Appeal
                $appeal->attachments()->attach($attachment->id);
            }

        }

        // 3) Отправляем Mailable пользователю
        Mail::to($appeal->email)
            ->send(new AppealCreated($appeal));

        // 4) Возврат назад с «тоастом» и номером обращения
        return back()->with('toast',
            "Ваше обращение №{$appeal->id} успешно отправлено. " .
            "Копия направлена на {$appeal->email}."
        );
    }
}
