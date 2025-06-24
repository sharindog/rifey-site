<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppealRequest;
use App\Models\Appeal;
use Illuminate\Support\Facades\DB;
use Orchid\Attachment\File;
use Orchid\Attachment\Models\Attachment;

class AppealController extends Controller
{
    /* форма */
    public function create()
    {
        return view('appeal.create');
    }

    /* приём POST */
    public function store(AppealRequest $req)
    {
        DB::transaction(function () use ($req) {

            $data  = $req->validated();
            $files = $req->file('files', []);

            // убираем тех. поля
            unset($data['files'], $data['consent']);

            /** @var Appeal $appeal */
            $appeal = Appeal::create($data);

            /* -------- загружаем каждое вложение -------- */
            foreach ($files as $file) {
                // создаём Attachment и сохраняем файл
                /** @var Attachment $attach */
                $attach = (new File($file))->load();   // <-- ключевая строка

                // привязываем к обращению
                $appeal->attachments()->syncWithoutDetaching($attach->id);
            }
        });

        return back()->with('toast', 'Ваше обращение принято!');
    }
}
