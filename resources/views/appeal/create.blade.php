@extends('layouts.app')

@section('title','Обратная связь')

@section('content')
    <div class="bg-[#eef7e9] py-14">
        <div class="max-w-lg mx-auto px-4" x-data="appealForm()" x-cloak>

            {{-- Заголовок --}}
            <h1 class="text-3xl font-extrabold text-[#7BC043] mb-8 text-center">
                Форма обращения
            </h1>

            @if(session('toast'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 shadow">
                    {{ session('toast') }}
                </div>
            @endif

            {{-- Карточка --}}
            <form method="POST" action="{{ route('appeal.store') }}" enctype="multipart/form-data"
                  class="bg-white rounded-xl shadow-lg ring-1 ring-gray-200/60 p-8 sm:p-10 space-y-6">
                @csrf

                {{-- Категория --}}
                <fieldset>
                    <legend class="font-semibold text-gray-800 mb-2">Заявитель <span class="text-red-600">*</span></legend>
                    <div class="flex gap-6">
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="category" value="individual" x-model="category"
                                   class="accent-[#7BC043]">
                            <span class="text-sm">Физическое лицо</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="category" value="company" x-model="category"
                                   class="accent-[#7BC043]">
                            <span class="text-sm">Юридическое лицо</span>
                        </label>
                    </div>
                </fieldset>

                {{-- Тема --}}
                <div>
                    <label class="block font-medium text-gray-800 mb-1">Тема обращения <span class="text-red-600">*</span></label>
                    <select name="topic" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        <option disabled selected>— выберите тему —</option>
                        <option value="contract">Заключение договора</option>
                        <option value="coop_offer">Предложение о сотрудничестве</option>
                        <option value="buy_recyclables">Купить вторсырьё</option>
                        <option value="no_collection">Сообщить о невывозе мусора</option>
                        <option value="landfill">Сообщить о свалке</option>
                        <option value="tariff_question">Вопрос по стоимости</option>
                        <option value="billing_question">Вопрос по счетам</option>
                        <option value="other">Другое</option>
                    </select>
                    @error('topic') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Населённый пункт --}}
                <div>
                    <label class="block font-medium text-gray-800 mb-1">Населённый пункт <span class="text-red-600">*</span></label>
                    <input name="settlement" required value="{{ old('settlement') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                    @error('settlement') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Текст обращения --}}
                <div x-data="{len:{{ strlen(old('body',0)) }}}">
                    <label class="block font-medium text-gray-800 mb-1">
                        Текст обращения (до 500 симв.) <span class="text-red-600">*</span>
                    </label>
                    <textarea name="body" maxlength="500" required
                              x-on:input="len=$event.target.value.length"
                              class="w-full h-32 border border-gray-300 rounded-lg px-3 py-2 resize-y
                                 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">{{ old('body') }}</textarea>
                    <div class="text-right text-xs text-gray-500 mt-0.5"><span x-text="len"></span>/500</div>
                    @error('body') <p class="text-red-600 text-xs">{{ $message }}</p>@enderror
                </div>

                {{-- ФЛ поля --}}
                <template x-if="category==='individual'">
                    <div>
                        <label class="block font-medium text-gray-800 mb-1">ФИО <span class="text-red-600">*</span></label>
                        <input name="fio" required value="{{ old('fio') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        @error('fio') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </template>

                {{-- ЮЛ поля --}}
                <template x-if="category==='company'">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-gray-800 mb-1">ИНН <span class="text-red-600">*</span></label>
                            <input name="inn" required value="{{ old('inn') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                            @error('inn') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-800 mb-1">Контактное лицо <span class="text-red-600">*</span></label>
                            <input name="contact_name" required value="{{ old('contact_name') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                            @error('contact_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </template>

                {{-- Контакты --}}
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium text-gray-800 mb-1">Телефон <span class="text-red-600">*</span></label>
                        <input name="phone" required placeholder="+7 ___ ___-__-__" value="{{ old('phone') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800 mb-1">E-mail <span class="text-red-600">*</span></label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Повторное обращение --}}
                <div>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_repeat" value="1" x-model="isRepeat"
                               class="accent-[#7BC043]">
                        <span class="text-sm">Уже обращался по этому вопросу</span>
                    </label>
                    <div x-show="isRepeat" x-transition class="mt-3">
                        <label class="block font-medium text-gray-800 mb-1">Номер предыдущего обращения</label>
                        <input name="prev_number" value="{{ old('prev_number') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        @error('prev_number') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Вложения --}}
                <div>
                    <label class="block font-medium text-gray-800 mb-1">Вложения (до 4&nbsp;МБ)</label>
                    <input type="file" name="files[]" multiple
                           class="block w-full text-sm text-gray-700
                              file:mr-3 file:rounded-full file:border-0
                              file:bg-[#7BC043]/10 file:px-4 file:py-2
                              hover:file:bg-[#7BC043]/20 file:text-[#7BC043]">
                    @error('files.*') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Согласие --}}
                <label class="inline-flex items-start gap-3 text-sm">
                    <input type="checkbox" name="consent" required class="mt-1 accent-[#7BC043]">
                    <span>Я&nbsp;согласен(а) на&nbsp;обработку персональных данных</span>
                </label>
                @error('consent') <p class="text-red-600 text-xs">{{ $message }}</p>@enderror

                {{-- Кнопка --}}
                <div class="pt-1 text-center">
                    <button class="w-full sm:w-auto bg-[#7BC043] hover:bg-[#69af39]
                               text-white font-semibold px-8 py-2.5 rounded-full transition">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function appealForm(){
            return {
                category : '{{ old('category','individual') }}',
                isRepeat : {{ old('is_repeat')? 'true':'false' }},
            }
        }
    </script>
@endsection
