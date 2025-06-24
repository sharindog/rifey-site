<?php

namespace App\Orchid\Screens\Document;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DocumentCategoryListScreen extends Screen
{
    public function name(): string
    {
        return 'Категории документов';
    }

    public function description(): ?string
    {
        return 'Список категорий и их объём документов';
    }

    public function query(): iterable
    {
        return [
            'categories' => DocumentCategory::withCount('documents')
                ->orderByDesc('id')
                ->paginate(),
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать категорию')
                ->icon('bs.plus-circle')
                ->route('platform.documents.categories.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('categories', [
                TD::make('id', 'ID')->sort(),
                TD::make('title', 'Название')->sort(),
                TD::make('documents_count', 'Документов')
                    ->alignCenter(),
                TD::make('actions', 'Действия')
                    ->alignCenter()
                    ->width('130px')
                    ->render(function (DocumentCategory $cat) {
                        return DropDown::make()
                            ->icon('bs.three-dots')
                            ->list([
                                Link::make('Редактировать')
                                    ->icon('bs.pencil')
                                    ->route('platform.documents.categories.edit', $cat->id),

                                Button::make('Удалить')
                                    ->icon('bs.trash')
                                    ->confirm('Вы уверены? Категория и все её документы будут удалены.')
                                    ->method('remove', ['id' => $cat->id]),
                            ]);
                    }),
            ]),
        ];
    }

    public function remove(Request $request)
    {
        $id = $request->get('id');
        $category = DocumentCategory::find($id);

        if ($category) {
            $category->delete();
            Toast::info('Категория и её документы удалены');
        } else {
            Toast::warning('Категория не найдена');
        }

        return redirect()->route('platform.documents.categories.list');
    }
}
