<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make(__('Пользователи системы'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

#            Menu::make(__('Роли'))
#                ->icon('bs.shield')
#                ->route('platform.systems.roles')
#                ->permission('platform.systems.roles')
#                ->divider(),

            Menu::make('Новости')
                ->icon('bs.newspaper')
                ->route('platform.news')
                ->permission('news.view'),

            Menu::make('Обращения')
                ->icon('bs.envelope')
                ->route('platform.appeals')
                ->permission('appeals.view'),

            Menu::make('Документы')
                ->icon('bs.folder2-open')
                ->route('platform.documents.list'),

            Menu::make('Категории документов')
                ->icon('bs.tag')
                ->route('platform.documents.categories.list'),

            Menu::make('Фотогалерея')
                ->icon('bs.image')
                ->route('platform.photo.categories')     // ← наш экран со списком категорий
                ->permission('platform.media.photos'),

            Menu::make('Видеоролики')
                ->icon('bs.film')
                ->route('platform.video.list')
                ->permission('platform.media.videos'),

            Menu::make('Категории видео')
                ->icon('bs.collection')
                ->route('platform.video.categories')
                ->permission('platform.media.videos'),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('Система'))
                ->addPermission('platform.systems.roles', __('Роли'))
                ->addPermission('platform.systems.users', __('Пользователи')),

            ItemPermission::group('Новости')
                ->addPermission('news.view',   'Новости: просмотр')
                ->addPermission('news.manage', 'Новости: управление'),

            ItemPermission::group('Обращения')
                ->addPermission('appeals.view',   'Обращения: просмотр')
                ->addPermission('appeals.manage', 'Обращения: управление'),

            ItemPermission::group(__('Медиа'))
                ->addPermission('platform.media.photos',  'Управление фото')
                ->addPermission('platform.media.videos',  'Управление видео'),
        ];
    }
}
