<?php
namespace App\Orchid\Screens\Video;

use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;

class VideoEditScreen extends Screen
{
    /* ---------------- config ------------------------------------------ */
    public function name(): string { return 'Видео-ролик'; }

    public function query(Video $video = null): iterable
    {
        return ['video' => $video ?? new Video];
    }

    /* ---------------- buttons ----------------------------------------- */
    public function commandBar(): iterable
    {
        $exists = request()->route('video') !== null;

        return [
            Link::make('Назад')
                ->icon('bs.arrow-left')
                ->route('platform.video.list'),

            Button::make('Сохранить')
                ->icon('bs.save')
                ->method('save'),

            Button::make('Удалить')
                ->icon('bs.trash')
                ->method('remove')
                ->confirm('Удалить ролик?')
                ->canSee($exists),
        ];
    }

    /* ---------------- form -------------------------------------------- */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Relation::make('video.video_category_id')
                    ->fromModel(VideoCategory::class, 'title')
                    ->title('Категория')
                    ->required(),

                Input::make('video.title')->title('Название')->required(),

                Input::make('video.youtube_url')
                    ->title('YouTube-ссылка')
                    ->required(),

                DateTimer::make('video.published_at')
                    ->title('Дата публикации')
                    ->format('d.m.Y')
                    ->allowInput()
                    ->required(),
            ]),
        ];
    }

    /* ---------------- handlers ---------------------------------------- */
    public function save(Request $request)
    {
        $data   = $request->validate([
            'video.video_category_id' => 'required|exists:video_categories,id',
            'video.title'             => 'required|string|max:255',
            'video.youtube_url'       => 'required|string|max:255',
            'video.published_at'      => 'nullable|date',
        ])['video'];

        $video = request()->route('video') ?? new Video;
        $video->fill($data)->save();

        Alert::info('Видео сохранено');
        return redirect()->route('platform.video.list');
    }

    public function remove(Video $video)
    {
        $video->delete();
        Alert::info('Видео удалено');
        return redirect()->route('platform.video.list');
    }
}
