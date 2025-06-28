<header x-data="{ mobileOpen: false, dropdown: null }" class="bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Логотип -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/rifey-logo.png') }}" alt="РИФЕЙ" class="h-16 w-auto">
            </a>

            <!-- Десктоп‑навигация -->
            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium">
                @php
                    $nav = [
                        'О нас' => [
                            ['text' => 'Общие сведения', 'url' => route('about')],
                            ['text' => 'Вакансии', 'url' => 'https://nizhny-tagil.hh.ru/employer/4789107', 'blank' => true],
                            ['text' => 'Документы', 'url' => route('about.docs')],
                            ['text' => 'Мусоросортировочные комплексы', 'url' => route('about.msk')],
                            ['text' => 'ЭКОдом', 'url' => route('about.ecohouse')],
                            ['text' => 'Раскрытие информации', 'url' => route('about.disclosure')],
                            ['text' => 'Политика обработки ПД', 'url' => route('about.privacy')],
                        ],
                        'Клиентам' => [
                            ['text' => 'Деятельность регионального оператора', 'url' => route('clients.activity')],
                            ['text' => 'Заключение договора', 'url' => route('clients.contract')],
                            ['text' => 'График вывоза ТКО', 'url' => route('clients.schedule')],
                        ],
                        'Пресс‑центр' => [
                            ['text' => 'Новости', 'url' => route('news.index')],
                            ['text' => 'Фотогалерея', 'url' => route('media.photos')],
                            ['text' => 'Видеогалерея', 'url' => route('media.videos')],
                        ],
                    ];
                @endphp

                @foreach($nav as $label => $items)
                    <div class="relative" @mouseenter="dropdown = '{{ $label }}'" @mouseleave="dropdown = null">
                        <button class="flex items-center gap-1 transition-colors hover:text-[#69af39]">
                            {{ $label }}
                            <x-orchid-icon path="chevron-down"
                                           class="h-4 w-4 transition-transform"
                                           x-bind:class="dropdown === '{{ $label }}' ? 'rotate-180' : ''" />
                        </button>

                        <!-- Выпадающий список -->
                        <div x-cloak x-show="dropdown === '{{ $label }}'" x-transition class="absolute left-0 z-50 mt-2 w-64 rounded-md bg-white py-2 shadow-xl">
                            @foreach($items as $item)
                                <a href="{{ $item['url'] }}" @if(!empty($item['blank'])) target="_blank" @endif class="block px-4 py-2 text-sm text-gray-700 transition hover:bg-[#f3fef2] hover:text-[#69af39]">
                                    {{ $item['text'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <a href="https://zakupki-rifei.rts-tender.ru/" target="_blank" class="transition-colors hover:text-[#69af39]">Закупки</a>
                <a href="{{ route('contacts') }}" class="transition-colors hover:text-[#69af39]">Контакты</a>
                <a href="{{ route('appeal.create') }}" class="transition-colors hover:text-[#69af39]">Обратная связь</a>
            </nav>

            <!-- Телефон горячей линии (десктоп) -->
            <div class="hidden lg:flex flex-col text-right text-xs">
                <span class="uppercase tracking-wide text-gray-500">Телефон горячей линии</span>
                <span class="font-semibold text-[#7BC043]">8-800-234-02-43</span>
            </div>

            <!-- Бургер‑меню (моб.) -->
            <button class="p-2 lg:hidden" @click="mobileOpen = !mobileOpen">
                <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div> <!-- ← вот это закрытие и было пропущено -->
    </div>

    <!-- Мобильное меню -->
    <div x-cloak x-show="mobileOpen" x-transition class="lg:hidden border-t bg-white">
        <div class="px-4 pt-4 pb-6 text-sm space-y-4">
            @foreach($nav as $label => $items)
                <div x-data="{ open: false }">
                    <button
                            @click="open = !open"
                            class="flex w-full items-center justify-between text-base font-medium text-gray-800 hover:text-[#69af39]">
                        {{ $label }}
                        <svg :class="open ? 'rotate-45 text-[#69af39]' : 'text-gray-400'" class="h-5 w-5 transform transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 ml-3 space-y-1 text-gray-700">
                        @foreach($items as $item)
                            <a href="{{ $item['url'] }}" @if(!empty($item['blank'])) target="_blank" @endif class="block pl-1 border-l border-gray-200 hover:text-[#69af39]">
                                {{ $item['text'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="pt-2 space-y-1">
                <a href="https://zakupki-rifei.rts-tender.ru/" target="_blank" class="block text-base hover:text-[#69af39]">Закупки</a>
                <a href="{{ route('contacts') }}" class="block text-base hover:text-[#69af39]">Контакты</a>
                <a href="{{ route('appeal.create') }}" class="block text-base hover:text-[#69af39]">Обратная связь</a>
            </div>

            <div class="border-t pt-4 text-xs">
                <span class="block uppercase text-gray-500">Горячая линия</span>
                <span class="block font-semibold text-[#7BC043] text-base">8-800-234-02-43</span>
            </div>
        </div>
    </div>
</header>
