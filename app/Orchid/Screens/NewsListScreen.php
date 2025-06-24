<?php

namespace App\Orchid\Screens;

use App\Models\News;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Icon\Icon;

class NewsListScreen extends Screen
{
    public string $name = 'Новости';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'news' => News::query()
                ->select('id', 'title', 'excerpt', 'published_at', 'is_published', 'content', 'created_at', 'updated_at')
                ->latest()
                ->paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Новости';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить')
                ->icon('plus')
                ->route('platform.news.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
         * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('news', [
                TD::make('title', 'Заголовок')
                    ->render(fn (News $news) =>
                    Link::make($news->title)
                        ->route('platform.news.edit', $news->id)
                    ),

                TD::make('excerpt', 'Краткое описание')
                    ->render(fn (News $news) => Str::limit($news->excerpt, 100)),

                TD::make('published_at', 'Дата публикации')
                    ->render(fn (News $news) =>
                    $news->published_at
                        ? Carbon::parse($news->published_at)->translatedFormat('j F Y H:i')
                        : '—'
                    ),

                TD::make('updated_at', 'Редактировано')
                    ->render(function (News $news) {
                        if (!$news->updated_at || !$news->created_at) {
                            return '—';
                        }

                        return $news->updated_at->timestamp !== $news->created_at->timestamp
                            ? $news->updated_at->translatedFormat('j F Y H:i')
                            : '—';
                    }),

                TD::make('is_published', 'Опубликовано')
                    ->render(fn (News $news) =>
                    $news->is_published
                        ? '<span style="color: green;">✔</span>'
                        : '<span style="color: red;">✘</span>'
                    )
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px'),
                ]),
        ];
    }
}
