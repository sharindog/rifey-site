@extends('layouts.app')

@section('title', 'ООО «Компания «РИФЕЙ»')

@section('content')

    {{-- HERO --}}
    <section class="relative py-28 text-white bg-[#7BC043] overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#7BC043]/90 to-[#7BC043]/60 opacity-80"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 flex flex-col items-center gap-10 text-center">
            <div>
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
                    Региональный оператор по обращению с&nbsp;ТКО
                </h1>
                <p class="text-xl md:text-2xl leading-relaxed">
                    Обслуживаем 23 муниципалитета Свердловской области современными и экологичными услугами.
                </p>
            </div>
            <a href="{{ route('appeal.create') }}"
               class="inline-block bg-white text-[#7BC043] font-semibold px-10 py-4 rounded-full shadow-lg hover:bg-gray-100 transition">
                Обратная связь
            </a>
            <div class="flex flex-wrap justify-center gap-4 text-sm md:text-base font-medium">
                <span class="px-4 py-2 rounded-full bg-white/30 backdrop-blur-md">170+ единиц техники</span>
                <span class="px-4 py-2 rounded-full bg-white/30 backdrop-blur-md">11 полигонов ТКО</span>
                <span class="px-4 py-2 rounded-full bg-white/30 backdrop-blur-md">1 млн+ жителей</span>
            </div>
        </div>
    </section>

    {{-- Миссия --}}
    <section class="bg-white py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6 text-[#7BC043]">Наша миссия</h2>
            <p class="text-graphite text-lg leading-relaxed">
                Повысить экологическую безопасность и улучшить качество жизни граждан
                через эффективную систему обращения с отходами.
            </p>
        </div>
    </section>

    {{-- Что мы делаем --}}
    <section class="bg-[#7BC043]/5 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-12 text-[#7BC043] text-center">Что мы делаем</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                @foreach([
                    ['Сбор ТКО',        'Вывоз отходов с контейнерных площадок 23 муниципалитетов.'],
                    ['Транспортировка', 'Оптимальные логистические маршруты и экологически безопасные перевозки.'],
                    ['Сортировка',      'Работа 2 мусоросортировочных комплексов в регионе.'],
                    ['Обратная связь',  'Цифровая система приёма заявок и публичные отчёты.'],
                ] as [$title, $desc])
                    <div class="bg-white rounded-2xl p-8 shadow-md border-t-4" style="border-top-color:#7BC043">
                        <div class="text-2xl font-bold text-[#7BC043] mb-2">{{ $title }}</div>
                        <p class="text-graphite">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Цифры и факты --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-12 text-[#7BC043] text-center">Цифры и факты</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['170+',       'единиц техники'],
                    ['11',         'полигонов ТКО'],
                    ['2',          'мусоросортировочных комплекса'],
                    ['1 млн+',     'жителей в зоне охвата'],
                ] as [$num, $txt])
                    <div class="bg-white rounded-2xl shadow-md p-8 text-center border-t-4" style="border-top-color:#7BC043">
                        <div class="text-4xl font-extrabold text-[#7BC043] mb-2">{{ $num }}</div>
                        <div class="text-graphite text-base font-medium">{{ $txt }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Последние новости --}}
    <section class="bg-[#7BC043]/5 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-10 text-[#7BC043] text-center">Последние новости</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
            <div class="mt-12 text-center">
                <a href="{{ route('news.index') }}"
                   class="inline-block bg-[#7BC043] text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-[#69af39] transition">
                    Все новости
                </a>
            </div>
        </div>
    </section>

    {{-- Горячая линия --}}
    <section class="bg-white py-20">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-[#7BC043] mb-4">Горячая линия</h2>
            <p class="text-graphite text-lg mb-2">Приём обращений ежедневно с 8:00 до 20:00</p>
            <p class="text-2xl font-bold text-[#7BC043]">8 800 100-84-44</p>
            <p class="text-gray-500 text-sm">звонок бесплатный</p>
        </div>
    </section>

    {{-- Обратная связь --}}
    <section class="bg-[#7BC043]/5 py-20">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-[#7BC043] mb-4">Есть вопрос или жалоба?</h2>
            <p class="text-graphite mb-6">
                Вы можете воспользоваться формой обратной связи или позвонить по горячей линии.
            </p>
            <a href="{{ route('appeal.create') }}"
               class="inline-block bg-[#7BC043] text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-[#69af39] transition mb-8">
                Обратная связь
            </a>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 items-center">
                {{-- Почта --}}
                <div class="text-gray-700 text-lg">
                    Email:&nbsp;
                    <a href="mailto:rifey-apo1@mail.ru"
                       class="text-[#7BC043] hover:underline">
                        rifey-apo1@mail.ru
                    </a>
                </div>

                {{-- Социальные сети --}}
                <div class="flex justify-center items-center gap-6">
                    {{-- VK --}}
                    <a href="https://vk.com/rif.ecotko" target="_blank"
                       class="text-gray-500 hover:text-[#7BC043] transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="16" height="16"
                             class="h-12 w-12"
                             fill="currentColor"
                             viewBox="0 0 24 24">
                            <path d="M21.579 6.855c.14-.465 0-.806-.662-.806h-2.193c-.558 0-.813.295-.953.619 0 0-1.115 2.719-2.695 4.482-.51.513-.743.675-1.021.675-.139 0-.341-.162-.341-.627V6.855c0-.558-.161-.806-.626-.806H9.642c-.348 0-.558.258-.558.504 0 .528.79.65.871 2.138v3.228c0 .707-.127.836-.407.836-.743 0-2.551-2.729-3.624-5.853-.209-.607-.42-.852-.98-.852H2.752c-.627 0-.752.295-.752.619 0 .582.743 3.462 3.461 7.271 1.812 2.601 4.363 4.011 6.687 4.011 1.393 0 1.565-.313 1.565-.853v-1.966c0-.626.133-.752.574-.752.324 0 .882.164 2.183 1.417 1.486 1.486 1.732 2.153 2.567 2.153h2.192c.626 0 .939-.313.759-.931-.197-.615-.907-1.51-1.849-2.569-.512-.604-1.277-1.254-1.51-1.579-.325-.419-.231-.604 0-.976.001.001 2.672-3.761 2.95-5.04z"/>
                        </svg>
                    </a>

                    {{-- WhatsApp --}}
                    <a href="https://wa.me/+79002021556" target="_blank"
                       class="text-gray-500 hover:text-[#7BC043] transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="16" height="16"
                             fill="currentColor"
                             class="h-8 w-8"
                             viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                        </svg>
                    </a>

                    {{-- Telegram --}}
                    <a href="https://t.me/tko_rifey" target="_blank"
                       class="text-gray-500 hover:text-[#7BC043] transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="16" height="16"
                             fill="currentColor"
                             class="h-8 w-8"
                             viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>



@endsection
