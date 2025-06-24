<?php
namespace App\Orchid\Screens\Video;

use App\Models\Video;
use App\Models\VideoCategory;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;

class VideoListScreen extends Screen
{
    public function name(): string   { return 'Видео-ролики'; }

    public function description(): ?string { return 'Все ролики, сгруппированные по категориям'; }

    public function query(): iterable
    {
        return [
            'videos' => Video::with('category')
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить ролик')
                ->icon('bs.plus-circle')
                ->route('platform.video.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('videos', [
                TD::make('id', 'ID')->sort(),

                TD::make('title', 'Название')->filter(TD::FILTER_TEXT)->sort(),

                TD::make('video_category_id', 'Категория')
                    ->render(fn(Video $v) => $v->category->title ?? '—')
                    ->filter(
                        TD::FILTER_SELECT,
                        VideoCategory::pluck('title', 'id')->toArray()
                    ),

                TD::make('published_at', 'Дата публикации')
                    ->sort()
                    ->render(fn(Video $v) => $v->published_at?->format('d.m.Y')),

                TD::make('created_at', 'Создано')
                    ->render(fn(Video $v) => $v->created_at?->format('d.m.Y')),

                TD::make('actions')
                    ->alignCenter()
                    ->width('100px')
                    ->render(fn(Video $v) => DropDown::make()
                        ->icon('bs.three-dots')
                        ->list([
                            Link::make('Редактировать')
                                ->route('platform.video.edit', $v)->icon('bs.pencil'),
                        ])),
            ]),
        ];
    }
}
