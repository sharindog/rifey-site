<?php
namespace App\Orchid\Screens\Photo;

use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Attach;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;

class PhotoCategoryEditScreen extends Screen
{
    public function name(): string
    {
        return 'Категория фото';
    }

    /**
     * Получаем категорию (либо новую)
     */
    public function query(PhotoCategory $category = null): iterable
    {
        return ['category' => $category ?? new PhotoCategory];
    }

    /**
     * Верхние кнопки
     */
    public function commandBar(): iterable
    {
        $exists = request()->route('category') !== null;

        return [
            Link::make('Назад')
                ->icon('bs.arrow-left')
                ->route('platform.photo.categories'),

            Button::make('Сохранить')
                ->icon('bs.save')
                ->method('save'),

            Button::make('Удалить')
                ->icon('bs.trash')
                ->method('remove')
                ->confirm('Удалить категорию и все фото?')
                ->canSee($exists),
        ];
    }

    /**
     * Форма: скрытый id, название и Attach
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                // Скрытое поле id, чтобы в save() определить, создаём или редактируем
                Input::make('category.id')->type('hidden'),

                Input::make('category.title')
                    ->title('Название категории')
                    ->required(),

                Attach::make('category.attachments')
                    ->title('Фотографии')
                    ->multiple(),
            ]),
        ];
    }

    /**
     * Сохраняем категорию и синхронизируем вложения
     */
    public function save(Request $request)
    {
        // 1) Валидация
        $validated = $request->validate([
            'category.id'            => 'nullable|integer|exists:photo_categories,id',
            'category.title'         => 'required|string|max:255',
            'category.attachments'   => 'nullable|array',
            'category.attachments.*' => 'integer',
        ])['category'];

        // 2) Найти или создать модель
        if (! empty($validated['id'])) {
            $category = PhotoCategory::findOrFail($validated['id']);
        } else {
            $category = new PhotoCategory;
        }

        // 3) Заполнить и сохранить title
        $category->title = $validated['title'];
        $category->save();

        // 4) Orchid Attachable: синхронизируем связанные файлы
        //    relation из Attachable-трейта называется `attachments()`
        $category->attachments()->sync($validated['attachments'] ?? []);

        Alert::info('Категория и фотографии сохранены');
        return redirect()->route('platform.photo.categories');
    }

    /**
     * Удаляем категорию вместе со всеми pivot-складами
     */
    public function remove(PhotoCategory $category)
    {
        $category->delete();
        Alert::info('Категория удалена');
        return redirect()->route('platform.photo.categories');
    }
}
