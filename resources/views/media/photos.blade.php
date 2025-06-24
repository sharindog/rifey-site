@extends('layouts.app')
@section('title', 'Фотогалерея')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css">
@endpush

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-800">

            <h1 class="text-3xl font-bold text-green-600 mb-8">Фотогалерея</h1>

            @forelse($categories as $category)
                <h2 class="text-2xl font-semibold mt-12">{{ $category->title }}</h2>
                <div class="swiper mySwiper-{{ $category->id }} mt-4">
                    <div class="swiper-wrapper">
                        @foreach($category->attachments as $attachment)
                            <div class="swiper-slide">
                                <img src="{{ $attachment->url() }}"
                                     alt="{{ $attachment->original_name }}"
                                     class="w-full h-auto rounded-xl shadow photo-thumb cursor-pointer">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            @empty
                <p class="text-gray-600">Пока нет ни одной категории с фото.</p>
            @endforelse

            {{-- Лайтбокс --}}
            <div id="lightbox"
                 class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
                <div id="lightbox-content" class="relative">
                    <img id="lightbox-img"
                         class="max-w-screen max-h-screen rounded-lg shadow-lg"
                         src="" alt="">
                    <button id="lightbox-close"
                            class="absolute top-2 right-2 text-white bg-black bg-opacity-50 hover:bg-opacity-75
                       rounded-full p-2 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
    <script>
        // 1. Инициализация Swiper
        @foreach($categories as $category)
        new Swiper('.mySwiper-{{ $category->id }}', {
            loop: true,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
        @endforeach

        // 2. Делегированное открытие лайтбокса с любым .photo-thumb
        const lightbox      = document.getElementById('lightbox');
        const lightboxImg   = document.getElementById('lightbox-img');
        const lightboxClose = document.getElementById('lightbox-close');
        const lightboxContent = document.getElementById('lightbox-content');

        document.body.addEventListener('click', e => {
            const thumb = e.target.closest('.photo-thumb');
            if (!thumb) return;
            lightboxImg.src = thumb.src;
            lightbox.classList.remove('hidden');
        });

        // 3. Закрытие: по крестику
        lightboxClose.addEventListener('click', e => {
            e.stopPropagation();
            lightbox.classList.add('hidden');
        });

        // 4. Закрытие: по фону
        lightbox.addEventListener('click', () => {
            lightbox.classList.add('hidden');
        });

        // 5. Предотвратить закрытие при клике внутри контента
        lightboxContent.addEventListener('click', e => {
            e.stopPropagation();
        });

        // 6. Закрытие по клавише ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                lightbox.classList.add('hidden');
            }
        });
    </script>
@endpush
