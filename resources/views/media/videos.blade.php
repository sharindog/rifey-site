@extends('layouts.app')
@section('title','Видео')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-800">

            <h1 class="text-3xl font-bold text-green-600 mb-8">Видеогалерея</h1>

            @foreach($categories as $cat)
                <h2 class="text-2xl font-semibold mt-12">{{ $cat->title }}</h2>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @foreach($cat->videos as $v)
                        <div class="space-y-2">
                            <div class="w-full aspect-video rounded-xl overflow-hidden shadow">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ preg_replace('~^.+v=|^.+be/~','',$v->youtube_url) }}"
                                    frameborder="0" allowfullscreen class="w-full h-full"></iframe>
                            </div>
                            <h3 class="font-semibold">{{ $v->title }}</h3>
                            @if($v->published_at)
                                <p class="text-sm text-gray-500">{{ $v->published_at->format('d.m.Y') }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
@endsection
