@if (!request()->cookie('cookie_accepted'))
    <div
            x-data="{ open: false }"
            x-show="open"
            x-init="
        open = !document.cookie.includes('cookie_accepted=true');
    "
            x-transition
            style="display: none;"
            class="fixed bottom-0 left-0 right-0 z-50 px-4 pb-4 sm:pb-6 sm:px-6"
    >
        <div class="bg-white rounded-lg shadow-xl border border-gray-200 text-gray-800 px-5 py-4 text-sm sm:text-base max-w-5xl mx-auto">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex-1">
                    <p class="font-semibold">Мы используем cookies для корректной работы сайта.</p>
                    <p class="text-gray-600 mt-1">
                        Эти небольшие файлы сохраняют ваши настройки и помогают удобно использовать сайт.
                        Продолжая использовать сайт, вы соглашаетесь с нашей
                        <a href="/privacy" class="text-green-700 underline hover:text-green-800">политикой конфиденциальности</a>.
                    </p>
                </div>
                <button
                        @click="
                    open = false;
                    document.cookie = 'cookie_accepted=true; path=/; max-age=31536000';
                "
                        class="w-full sm:w-auto bg-green-600 hover:bg-green-700 transition text-white px-5 py-2 rounded-md text-sm font-semibold text-center"
                >
                    Принять
                </button>
            </div>
        </div>
    </div>
@endif
