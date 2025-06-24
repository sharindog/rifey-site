<?php

namespace App\Orchid\Screens\Document;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Attach;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class DocumentEditScreen extends Screen
{
    /** @var Document */
    public $document;

    public function query(?Document $document): array
    {
        return [
            'document' => $document ?? new Document(),
        ];
    }



    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->document->exists ? 'Редактировать документ' : 'Создать документ';
    }

    public function description(): ?string
    {
        return 'Добавление и редактирование документов';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Назад')->route('platform.documents.list'),
            Button::make('Сохранить')->method('save')->icon('bs.save'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('document.title')
                    ->title('Название документа')
                    ->required(),

                Relation::make('document.document_category_id')
                    ->title('Категория')
                    ->fromModel(DocumentCategory::class, 'title')
                    ->required(),
                Attach::make('file_id')
                ->title('Файл (PDF, DOC, DOCX)')
                ->accept('image/*,.doc,.docx,application/pdf')
            ]),
        ];
    }

    public function save(Request $request)
    {
        // 1) Извлекаем данные формы (title, document_category_id)
        $data = $request->get('document');

        // 2) Извлекаем ID файла из Upload
        $fileId = collect($request->input('file_id', []))
            ->filter()
            ->first();

        // 3) Если файл загружен — добавляем в массив данных
        if ($fileId) {
            $data['file'] = (int) $fileId;
        }

        // 4) Сохраняем модель сразу с полем file
        $this->document->fill($data)->save();

        Alert::info('Документ сохранён');
        return redirect()->route('platform.documents.list');
    }

}
