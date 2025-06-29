<?php

namespace App\Orchid\Screens;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;      // ← Quill WYSIWYG
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use OrchidCommunity\TinyMCE\TinyMCE;

class NewsEditScreen extends Screen
{
    public bool $exists = false;

    public function query(News $news): array
    {
        $this->exists = $news->exists;
        return ['news' => $news];
    }

    public function name(): ?string
    {
        return 'Работа с новостью';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')->icon('arrow-left')->route('platform.news'),
            Button::make('Сохранить')->icon('check')->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('news.title')
                    ->title('Заголовок')
                    ->required(),

                Input::make('news.slug')
                    ->title('Слаг')
                    ->disabled()
                    ->canSee($this->exists),

                TextArea::make('news.excerpt')
                    ->title('Краткое описание')
                    ->rows(8),

                TinyMCE::make('news.content')
                ->title('Текст новости')
                ->height(500),

                Switcher::make('news.is_published')
                    ->title('Опубликовано')
                    ->sendTrueOrFalse(),
            ]),
        ];
    }

    public function save(News $news, Request $request)
    {
        $data                 = $request->input('news');
        $data['slug']         = Str::slug($data['title']);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['published_at'] = $data['is_published'] ? Carbon::now() : null;

        $news->fill($data)->save();

        Toast::info('Новость сохранена');
        return redirect()->route('platform.news');
    }
}
