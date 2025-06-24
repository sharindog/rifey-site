<?php

declare(strict_types=1);

use App\Orchid\PlatformScreen;
use App\Orchid\Screens\Appeal\AppealEditScreen;
use App\Orchid\Screens\Appeal\AppealListScreen;
use App\Orchid\Screens\Document\DocumentCategoryEditScreen;
use App\Orchid\Screens\Document\DocumentCategoryListScreen;
use App\Orchid\Screens\Document\DocumentEditScreen;
use App\Orchid\Screens\Document\DocumentListScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\NewsEditScreen;
use App\Orchid\Screens\NewsListScreen;
use App\Orchid\Screens\Photo\PhotoCategoryEditScreen;
use App\Orchid\Screens\Photo\PhotoCategoryListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Video\VideoCategoryEditScreen;
use App\Orchid\Screens\Video\VideoCategoryListScreen;
use App\Orchid\Screens\Video\VideoEditScreen;
use App\Orchid\Screens\Video\VideoListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

// Route::screen('idea', Idea::class, 'platform.screens.idea');

Route::screen('news', NewsListScreen::class)->name('platform.news');
Route::screen('news/create', NewsEditScreen::class)->name('platform.news.create');
Route::screen('news/{news}/edit', NewsEditScreen::class)->name('platform.news.edit');

Route::screen('appeals', AppealListScreen::class)
    ->name('platform.appeals')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Обращения'));

Route::screen('appeals/{appeal}/edit', AppealEditScreen::class)
    ->name('platform.appeals.edit')
    ->breadcrumbs(fn (Trail $trail, $appeal) => $trail
        ->parent('platform.appeals')
        ->push('Обращение #'.$appeal->id));

// Категории
Route::screen('documents/categories', DocumentCategoryListScreen::class)
    ->name('platform.documents.categories.list');
Route::screen('documents/categories/create', DocumentCategoryEditScreen::class)
    ->name('platform.documents.categories.create');
Route::screen('documents/categories/{category}/edit', DocumentCategoryEditScreen::class)
    ->name('platform.documents.categories.edit');

// Документы
Route::screen('documents', DocumentListScreen::class)
    ->name('platform.documents.list');
Route::screen('documents/create', DocumentEditScreen::class)
    ->name('platform.documents.create');
Route::screen('documents/{document}/edit', DocumentEditScreen::class)
    ->name('platform.documents.edit');

/* Фото */
Route::screen('photo/categories',          PhotoCategoryListScreen::class)->name('platform.photo.categories');
Route::screen('photo/categories/create',   PhotoCategoryEditScreen::class)->name('platform.photo.categories.create');
Route::screen('photo/categories/{category}/edit', PhotoCategoryEditScreen::class)->name('platform.photo.categories.edit');

/* Видео – категории */
Route::screen('video/categories',          VideoCategoryListScreen::class)->name('platform.video.categories');
Route::screen('video/categories/create',   VideoCategoryEditScreen::class)->name('platform.video.categories.create');
Route::screen('video/categories/{category}/edit', VideoCategoryEditScreen::class)->name('platform.video.categories.edit');

/* Видео – ролики */
Route::screen('videos',                    VideoListScreen::class)->name('platform.video.list');
Route::screen('videos/create',             VideoEditScreen::class)->name('platform.video.create');
Route::screen('videos/{video}/edit',       VideoEditScreen::class)->name('platform.video.edit');
