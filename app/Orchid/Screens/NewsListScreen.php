<?php

namespace App\Orchid\Screens;

use App\Models\News;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;   // ← добавили
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;

class NewsListScreen extends Screen
{
    public string $name = 'Новости';

    public function query(): iterable
    {
        return [
            'news' => News::select('id', 'title', 'excerpt', 'published_at',
                'is_published', 'created_at', 'updated_at')
                ->latest()
                ->paginate(10),
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить')->icon('plus')->route('platform.news.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('news', [
                // Заголовок
                TD::make('title', 'Заголовок')
                    ->width('250px')
                    ->render(fn (News $n) =>
                    Link::make(Str::limit($n->title, 50, '…'))
                        ->route('platform.news.edit', $n->id)
                    ),

                // Краткое описание
                TD::make('excerpt', 'Описание')
                    ->width('250px')
                    ->render(fn (News $n) => Str::limit($n->excerpt, 60, '…')),

                // Дата публикации
                TD::make('published_at', 'Публикация')
                    ->width('160px')
                    ->render(fn (News $n) =>
                    $n->published_at
                        ? Carbon::parse($n->published_at)->translatedFormat('d.m.Y H:i')
                        : '—'
                    ),

                // Редактировано
                TD::make('updated_at', 'Редактировано')
                    ->width('160px')
                    ->render(fn (News $n) =>
                    ($n->updated_at && $n->updated_at->ne($n->created_at))
                        ? $n->updated_at->translatedFormat('d.m.Y H:i')
                        : '—'
                    ),

                // Статус (✔ / ✘) — выводим как HtmlString
                TD::make('is_published', 'Статус')
                    ->alignCenter()
                    ->width('110px')
                    ->render(fn (News $n) => new HtmlString(
                        $n->is_published
                            ? '<span style="color:#16a34a;">✔</span>'
                            : '<span style="color:#dc2626;">✘</span>'
                    )),
            ]),
        ];
    }
}
