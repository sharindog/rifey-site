<?php
namespace App\Orchid\Screens\Video;

use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;

class VideoCategoryEditScreen extends Screen
{
    /* ─────────────────────────────── конфиг ─────────────────────────── */
    public function name(): string { return 'Категория видео'; }

    public function query(VideoCategory $category): iterable
    {
        return ['category' => $category];
    }

    /* ─────────────────────────────── кнопки ─────────────────────────── */
    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')
                ->icon('bs.arrow-left')
                ->route('platform.video.categories'),

            Button::make('Сохранить')
                ->icon('bs.save')
                ->method('save'),

            Button::make('Удалить')
                ->icon('bs.trash')
                ->method('remove')
                ->confirm('Удалить категорию?')
                ->canSee(request()->route('category') !== null),
        ];
    }

    /* ─────────────────────────────── форма ──────────────────────────── */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('category.title')
                    ->title('Название категории')
                    ->required(),
            ]),
        ];
    }

    /* ─────────────────────────────── методы ─────────────────────────── */
    public function save(Request $request)
    {
        $data = $request->validate(['category.title' => 'required|string|max:255'])['category'];
        /** @var VideoCategory $category */
        $category = request()->route('category') ?? new VideoCategory;
        $category->fill($data)->save();

        Alert::info('Категория сохранена');
        return redirect()->route('platform.video.categories');
    }

    public function remove(VideoCategory $category)
    {
        $category->delete();
        Alert::info('Категория удалена');
        return redirect()->route('platform.video.categories');
    }
}
