<?php
namespace App\Orchid\Screens\Video;

use App\Models\VideoCategory;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class VideoCategoryListScreen extends Screen
{
    public function name(): string
    {
        return 'Категории видео';
    }

    public function query(): iterable
    {
        return [
            'categories' => VideoCategory::paginate(),
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')
                ->icon('bs.plus-circle')
                ->route('platform.video.categories.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('categories', [
                TD::make('id', 'ID')->sort(),

                TD::make('title', 'Название')
                    ->sort()
                    ->filter(TD::FILTER_TEXT),

                TD::make('created_at', 'Создано')
                    ->render(fn ($cat) => $cat->created_at?->format('d.m.Y'))
                    ->sort(),

                TD::make('')
                    ->render(fn ($cat) =>
                    Link::make('Открыть')
                        ->route('platform.video.categories.edit', $cat)
                    ),
            ]),
        ];
    }
}
