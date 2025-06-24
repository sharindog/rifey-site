<?php

namespace App\Orchid\Screens\Document;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DocumentListScreen extends Screen
{
    public function name(): string
    {
        return 'Документы';
    }

    public function description(): ?string
    {
        return 'Список всех загруженных документов';
    }

    public function query(): iterable
    {
        return [
           'documents' => Document::with(['category', 'attachment'])
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];

    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить документ')
                ->icon('bs.plus-circle')
                ->route('platform.documents.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('documents', [
                TD::make('id', 'ID')->sort(),

                TD::make('title', 'Название')
                    ->filter(TD::FILTER_TEXT)
                    ->sort(),

                TD::make('document_category_id', 'Категория')
                    ->render(fn(Document $d) => $d->category->title ?? '—')
                    ->filter(
                        TD::FILTER_SELECT,
                        DocumentCategory::pluck('title', 'id')->toArray()
                    ),
                TD::make('file', 'Файл')
                    ->render(fn(Document $d) =>
                    $d->attachment
                        ? new HtmlString(
                        "<a href=\"{$d->attachment->url()}\" target=\"_blank\">Скачать</a>"
                    )
                        : '—'
                    ),

                TD::make('actions', 'Действия')
                    ->alignCenter()
                    ->width('150px')
                    ->render(function (Document $d) {
                        return DropDown::make()
                            ->icon('bs.three-dots')
                            ->list([
                                Link::make('Редактировать')
                                    ->route('platform.documents.edit', $d->id)
                                    ->icon('bs.pencil'),
                                Button::make('Удалить')
                                    ->confirm('Вы уверены?')
                                    ->method('remove', ['id' => $d->id])
                                    ->icon('bs.trash'),
                            ]);
                    }),
            ]),
        ];
    }

    public function remove(Request $request)
    {
        if ($doc = Document::find($request->input('id'))) {
            $doc->delete();
            Toast::info('Документ удалён');
        } else {
            Toast::warning('Документ не найден');
        }
    }
}
