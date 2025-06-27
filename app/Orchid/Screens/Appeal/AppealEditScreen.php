<?php

namespace App\Orchid\Screens\Appeal;

use App\Models\Appeal;
use Carbon\Carbon;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\{Label, Select, CheckBox};
use Orchid\Screen\Actions\{Link, Button, ModalToggle};
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\TD;

class AppealEditScreen extends Screen
{
    public ?Appeal $appeal = null;

    public function query(Appeal $appeal): iterable
    {
        Carbon::setLocale('ru');
        $appeal->load(['attachments', 'statusLogs.user']);

        return [
            'appeal'            => $appeal,
            'logs'              => $appeal->statusLogs->sortByDesc('changed_at')->values(),
            'category_readable' => $appeal->category === 'individual'
                ? 'Физ. лицо'
                : 'Юр. лицо',
            'topic_readable'    => __('appeal.topic.' . $appeal->topic),
            'created_human'     => $appeal->created_at->translatedFormat('j F Y H:i'),
        ];
    }

    public function name(): ?string
    {
        return 'Карточка обращения № ' . $this->appeal->id;
    }

    public function permission(): iterable
    {
        return ['appeals.view'];
    }

    public function styles(): iterable
    {
        return [asset('build/assets/appeal.css')];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')->icon('arrow-left')->route('platform.appeals'),

            Button::make('Сохранить')
                ->icon('check')
                ->method('save')
                ->canSee(auth()->user()->hasAccess('appeals.manage')),

            ModalToggle::make('История')
                ->icon('history')
                ->modal('historyModal')
                ->modalTitle('История статусов'),
        ];
    }

    public function layout(): iterable
    {
        return array_merge(
            $this->cardBlocks(),

            [
                Layout::modal('historyModal', [
                    Layout::table('logs', [
                        TD::make('changed_at', 'Дата')
                            ->render(fn ($l) => $l->changed_at->translatedFormat('d.m.Y H:i'))
                            ->sort(),
                        TD::make('user.name', 'Кто'),
                        TD::make('from_status', 'Было')
                            ->render(fn ($l) => __('appeal.status.' . $l->from_status)),
                        TD::make('to_status', 'Стало')
                            ->render(fn ($l) => __('appeal.status.' . $l->to_status)),
                    ]),
                ])
                    ->size(Modal::SIZE_LG)
                    ->withoutApplyButton(),
            ]
        );
    }

    private function cardBlocks(): array
    {
        $rows = [
            Layout::rows([
                Select::make('appeal.status')
                    ->title('Статус')
                    ->options([
                        'new'      => 'Новое',
                        'in_work'  => 'В работе',
                        'answered' => 'Ответ дан',
                        'closed'   => 'Закрыто',
                    ])
                    ->canSee(auth()->user()->hasAccess('appeals.manage')),

                Label::make('appeal.id')->title('№ обращения'),
                Label::make('created_human')->title('Создано'),
                Label::make('category_readable')->title('Категория'),
                Label::make('topic_readable')->title('Тема'),
                Label::make('appeal.settlement')->title('Нас. пункт'),

                Label::make()
                    ->title('Текст обращения')
                    ->value(fn () => nl2br(e($this->appeal->body)))
                    ->asHtml(),
            ]),
        ];

        if ($this->appeal->category === 'individual') {
            $rows[] = Layout::rows([
                Label::make('appeal.fio')->title('ФИО'),
            ]);
        } else {
            $rows[] = Layout::rows([
                Label::make('appeal.inn')->title('ИНН'),
                Label::make('appeal.contact_name')->title('Контактное лицо'),
            ]);
        }

        $rows[] = Layout::rows([
            Label::make('appeal.phone')->title('Телефон'),
            Label::make('appeal.email')->title('E-mail'),
        ]);

        if ($this->appeal->is_repeat) {
            $rows[] = Layout::rows([
                CheckBox::make('appeal.is_repeat')
                    ->title('Повторное обращение')
                    ->disabled(),

                Label::make('appeal.prev_number')->title('№ предыдущего'),
            ]);
        }

        // Здесь подключаем новый partial
        $rows[] = Layout::view(
            'appeal.partials.attachments',
            ['attachments' => $this->appeal->attachments]
        );

        return $rows;
    }

    public function save(Appeal $appeal)
    {
        $data = request()->validate([
            'appeal.status' => 'required|in:new,in_work,answered,closed',
        ])['appeal'];

        $appeal->fill($data)->save();

        \Orchid\Support\Facades\Toast::info('Статус обновлён');

        return back();
    }
}
