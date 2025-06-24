<?php

namespace App\Orchid\Screens;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\{Input, SimpleMDE, Switcher, RichText, DateTimer, TextArea};
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;

class NewsEditScreen extends Screen
{
    public $name = 'Редактировать новость';
    public $description = 'Создание и редактирование новостей';

    public $exists = false;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(News $news): array
    {
        $this->exists = $news->exists;

        return [
            'news' => $news,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Работа с новостью';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')
                ->icon('arrow-left')
                ->route('platform.news'),

            Button::make('Сохранить')
                ->icon('check')
                ->method('save'),
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
            Layout::rows([
                Input::make('news.title')
                    ->title('Заголовок новости')
                    ->placeholder('Введите заголовок')
                    ->required(),

                // Только при редактировании — показываем slug, но не даём редактировать
                Input::make('news.slug')
                    ->title('Слаг (адрес)')
                    ->disabled()
                    ->canSee($this->exists),

                TextArea::make('news.excerpt')
                    ->title('Краткое описание')
                    ->rows(3),

                SimpleMDE::make('news.content')
                    ->title('Текст новости (Markdown)')
                    ->required()
                    ->rows(10),

                Switcher::make('news.is_published')
                    ->title('Опубликовано')
                    ->sendTrueOrFalse(),
            ]),
            # Логика проверки изменений на форме - НЕ РАБОТАЕТ!
            # Layout::view('admin.news.prevent-exit'),
        ];
    }

    public function save(News $news, Request $request) {
        $data = $request->get('news');

        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        $data['slug'] = Str::slug($data['title']);

        if (!$this->exists && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }

        $news->fill($data)->save();

        Toast::info('Новость сохранена!');
        return redirect()->route('platform.news');

    }
}
