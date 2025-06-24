<?php

namespace App\Orchid\Screens\Appeal;

use App\Models\Appeal;
use Illuminate\Support\Str;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Link;

class AppealListScreen extends Screen
{
    /** Заголовок страницы */
    public string $name = 'Обращения';

    /** Краткое описание */
    public string $description = 'Все обращения граждан и организаций';

    /** --- ДАННЫЕ ------------------------------------------------- */
    public function query(): iterable
    {
        return [
            // пагинация по 20
            'appeals' => Appeal::latest()->paginate(20),
        ];
    }

    /** --- Требуемые права --------------------------------------- */
    public function permission(): ?iterable
    {
        return ['appeals.view'];
    }

    /** --- Разметка ------------------------------------------------*/
    public function layout(): iterable
    {
        return [
            Layout::table('appeals', [
                TD::make('id', '№')
                    ->sort()
                    ->width('70'),

                TD::make('created_at', 'Дата')
                    ->render(fn (Appeal $a) => $a->created_at->format('d.m.Y H:i'))
                    ->sort(),

                TD::make('category', 'Категория')
                    ->render(fn (Appeal $a) =>
                    $a->category === 'individual' ? 'Физ. лицо' : 'Юр. лицо'
                    )
                    ->width('110'),

                TD::make('topic', 'Тема')
                    ->render(fn ($a) => __('appeal.topic.'.$a->topic))
                    ->filter(
                        TD::FILTER_SELECT,
                        [ // список опций
                            'contract'         => 'Договор',
                            'coop_offer'       => 'Сотрудничество',
                            'buy_recyclables'  => 'Вторсырьё',
                            'no_collection'    => 'Невывоз',
                            'landfill'         => 'Свалка',
                            'tariff_question'  => 'Тариф',
                            'billing_question' => 'Счета',
                            'other'            => 'Другое',
                        ]
                    ),

                TD::make('settlement', 'Нас. пункт')
                    ->width('160'),

                TD::make('body', 'Кратко')
                    ->render(fn (Appeal $a) => Str::limit($a->body, 50)),

                TD::make('status', 'Статус')
                    ->render(fn (Appeal $a) =>
                    view('components.status-badge', ['status' => $a->status])
                    )
                    ->width('120'),

                TD::make('action', '')
                    ->render(fn (Appeal $a) =>
                    Link::make('Открыть')
                        ->icon('arrow-right')
                        ->route('platform.appeals.edit', $a)
                    )
                    ->align(TD::ALIGN_RIGHT)
                    ->width('120'),
            ]),
        ];
    }
}
