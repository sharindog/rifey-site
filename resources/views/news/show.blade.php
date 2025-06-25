@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <section class="relative overflow-hidden"
             style="background:linear-gradient(135deg,#7BC043 0%,#69af39 100%);">
        <div class="mx-auto max-w-4xl px-4 py-20 text-center text-white">
            <h1 class="mb-3 text-3xl md:text-4xl font-extrabold leading-snug">
                {{ $news->title }}
            </h1>

            <div class="mx-auto h-px w-24 bg-white/30"></div>

            @if($news->excerpt)
                <p class="mt-4 mb-3 text-base font-medium text-white/90">
                    {{ $news->excerpt }}
                </p>
            @endif

            <p class="text-xs uppercase tracking-wider text-white/80">
                {{ optional($news->published_at)->translatedFormat('d F Y • H:i') }}
            </p>
        </div>
    </section>

    <section x-data="{ lightbox: null }" class="bg-white py-14">
        <div class="mx-auto max-w-3xl px-4">

            <article class="prose prose-lg text-gray-800 prose-img:rounded-xl prose-img:shadow-lg">
                {!! $news->content !!}
            </article>


            {{-- lightbox --}}
            <template x-if="lightbox">
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
                     x-cloak @click.away="lightbox=null" @keydown.escape.window="lightbox=null">
                    <img :src="lightbox"
                         class="max-h-[90vh] max-w-[90vw] rounded-2xl shadow-2xl">
                    <button @click="lightbox=null"
                            class="absolute top-6 right-6 text-white/80 hover:text-white text-2xl leading-none">
                        &times;
                    </button>
                </div>
            </template>

            <div class="mt-12 text-center">
                <a href="{{ route('news.index') }}"
                   class="inline-flex items-center gap-1 text-[#7BC043] font-semibold hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Все новости
                </a>
            </div>
        </div>
    </section>

    <section class="bg-[#7BC043]/5 py-14">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8 text-[#7BC043] text-center">Читайте также</h2>
            <div class="grid grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach(\App\Models\News::published()->latest()->take(3)->get() as $n)
                    <article class="bg-white rounded-2xl shadow-md p-6 flex flex-col border-t-4 hover:shadow-lg transition" style="border-top-color:#7BC043">
                        <h3 class="text-lg font-bold text-graphite mb-2 leading-tight">
                            <a href="{{ route('news.show', $n) }}" class="hover:text-[#7BC043]">{{ $n->title }}</a>
                        </h3>
                        <p class="text-sm text-gray-500 mb-3">{{ $n->published_at->translatedFormat('d F Y') }}</p>
                        <p class="text-graphite mb-6 line-clamp-4">{{ Str::limit($n->excerpt, 180) }}</p>
                        <a href="{{ route('news.show', $n) }}" class="mt-auto inline-block text-[#7BC043] font-semibold hover:underline">
                            Читать далее →
                        </a>
                    </article>
                @endforeach
            </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('lightbox', el => {
                el.querySelectorAll('img').forEach(img => {
                    img.addEventListener('click', () => {
                        el.__x.$data.lightbox = img.src
                    })
                })
            })
        })
    </script>
@endpush
