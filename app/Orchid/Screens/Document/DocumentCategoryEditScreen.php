<?php

namespace App\Orchid\Screens\Document;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class DocumentCategoryEditScreen extends Screen
{
    /** @var DocumentCategory */
    public $category;

    public function query(DocumentCategory $category = null): iterable
    {
        $this->category = $category ?? new DocumentCategory;

        return [
            'category' => $this->category,
        ];
    }

    public function name(): string
    {
        return $this->category->exists
            ? 'Редактировать категорию'
            : 'Создать категорию';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')
                ->route('platform.documents.categories.list')
                ->icon('bs.arrow-left'),

            Button::make('Сохранить')
                ->method('save')
                ->icon('bs.save'),
        ];
    }

    /* ---------- форма ---------- */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('category.title')
                    ->title('Название категории')
                    ->placeholder('Например: Персональные данные')
                    ->required(),
            ]),
        ];
    }

    public function save(Request $request)
    {
        $this->category->fill($request->get('category'))->save();

        Alert::info('Категория сохранена');
        return redirect()->route('platform.documents.categories.list');
    }
}
