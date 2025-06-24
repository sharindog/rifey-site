@extends('layouts.app')

@section('title', 'Новости — ООО Компания «РИФЕЙ»')

@section('content')
    <section class="py-16 bg-gray-light">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-graphite mb-10">Новости</h1>

            @if($news->isEmpty())
                <p class="text-gray-500">Пока нет опубликованных новостей.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($news as $item)
                        <article class="bg-white rounded-xl shadow-sm p-6 flex flex-col border hover:shadow-md transition-shadow">
                            <h2 class="text-lg font-bold text-graphite mb-2 leading-tight">
                                <a href="{{ route('news.show', $item->slug) }}" class="hover:text-green-rifey">
                                    {{ $item->title }}
                                </a>
                            </h2>

                            <p class="text-sm text-gray-500 mb-3">
                                {{ $item->published_at?->translatedFormat('d F Y') ?? '—' }}
                            </p>

                            <p class="text-gray-700 mb-6 line-clamp-4">
                                {{ \Illuminate\Support\Str::limit($item->excerpt, 180) }}
                            </p>

                            <a href="{{ route('news.show', $item->slug) }}"
                               class="mt-auto inline-block text-green-rifey font-semibold hover:underline">
                                Читать далее →
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
