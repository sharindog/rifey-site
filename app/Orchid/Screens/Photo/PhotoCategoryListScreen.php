<?php
namespace App\Orchid\Screens\Photo;

use App\Models\PhotoCategory;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class PhotoCategoryListScreen extends Screen
{
    public function query(): iterable
    {
        return ['categories' => PhotoCategory::paginate()];
    }

    public function name(): string { return 'Фотогалерея'; }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')->route('platform.photo.categories.create')->icon('bs.plus-circle'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('categories', [
                TD::make('id', 'ID')->sort(),
                TD::make('title', 'Название')->sort(),
                TD::make('created_at', 'Создано')
                    ->sort()
                    ->render(fn ($cat) => $cat->created_at?->format('d.m.Y')),
                TD::make('')->render(fn ($cat) => Link::make('Открыть')
                    ->route('platform.photo.categories.edit', $cat)),
            ]),
        ];
    }
}
