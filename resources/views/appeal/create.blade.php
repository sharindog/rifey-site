@extends('layouts.app')

@section('title', 'Обратная связь')

@section('content')
    <div class="bg-[#eef7e9] py-14"
         x-data="appealForm()"
         x-init="init()"
         x-cloak>

        <!-- ──────────── Модалка политики ПД ──────────── -->
        <div  x-show="showPolicy"
              x-transition.opacity
              class="fixed inset-0 bg-black/50 flex items-center justify-center z-[60]">

            <div class="bg-white rounded-xl shadow-xl max-w-3xl w-full h-[80vh] relative overflow-hidden">

                <!-- Круглая кнопка-крестик -->
                <button  aria-label="Закрыть"
                         class="absolute -right-3 -top-3 w-9 h-9 rounded-full bg-white
                                border border-gray-200 flex items-center justify-center
                                text-gray-500 hover:text-gray-700 hover:shadow transition"
                         @click="showPolicy = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <iframe src="{{ asset('documents/policies/personal-data-policy.pdf') }}"
                        class="w-full h-full rounded-b-xl"></iframe>
            </div>
        </div>
        <!-- ───────────────────────────────────────────── -->

        <div class="max-w-lg mx-auto px-4">
            <h1 class="text-3xl font-extrabold text-[#7BC043] mb-8 text-center">
                Форма обращения
            </h1>

            @if(session('toast'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 shadow">
                    {{ session('toast') }}
                </div>
            @endif

            <form  method="POST"
                   action="{{ route('appeal.store') }}"
                   enctype="multipart/form-data"
                   class="bg-white rounded-xl shadow-lg ring-1 ring-gray-200/60 p-8 sm:p-10 space-y-6">
                @csrf

                {{-- ───── категория ───── --}}
                <fieldset>
                    <legend class="font-semibold text-gray-800 mb-2">
                        Заявитель <span class="text-red-600">*</span>
                    </legend>
                    <div class="flex gap-6">
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="category" value="individual" x-model="category"
                                   required class="accent-[#7BC043]">
                            <span class="text-sm">Физическое лицо</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="category" value="company" x-model="category"
                                   required class="accent-[#7BC043]">
                            <span class="text-sm">Юридическое лицо</span>
                        </label>
                    </div>
                </fieldset>

                {{-- ───── тема обращения ───── --}}
                <div>
                    <label class="block font-medium text-gray-800 mb-1">
                        Тема обращения <span class="text-red-600">*</span>
                    </label>
                    <select name="topic" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                                   focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        <option disabled selected>— выберите тему —</option>
                        <option value="contract"         @selected(old('topic')=='contract')        >Заключение договора</option>
                        <option value="coop_offer"       @selected(old('topic')=='coop_offer')      >Предложение о сотрудничестве</option>
                        <option value="buy_recyclables"  @selected(old('topic')=='buy_recyclables') >Купить вторсырьё</option>
                        <option value="no_collection"    @selected(old('topic')=='no_collection')   >Сообщить о невывозе мусора</option>
                        <option value="landfill"         @selected(old('topic')=='landfill')        >Сообщить о свалке</option>
                        <option value="tariff_question"  @selected(old('topic')=='tariff_question') >Вопрос по тарифу</option>
                        <option value="billing_question" @selected(old('topic')=='billing_question')>Вопрос по счетам</option>
                        <option value="other"            @selected(old('topic')=='other')           >Другое</option>
                    </select>
                    {{-- читаемое сообщение об ошибке --}}
                    @error('topic')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

{{-- Населённый пункт --}}
                <div>
                    <label class="block font-medium text-gray-800 mb-1">
                        Населённый пункт <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                           name="settlement"
                           required
                           pattern=".*\S.*"
                           title="Поле не может быть пустым"
                           value="{{ old('settlement') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                    @error('settlement') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Текст обращения --}}
                <div x-data="{ len: {{ strlen(old('body','')) }} }">
                    <label class="block font-medium text-gray-800 mb-1">
                        Текст обращения (до 500 симв.) <span class="text-red-600">*</span>
                    </label>
                    <textarea name="body"
                              maxlength="500"
                              required
                              pattern=".*\S.*"
                              title="Поле не может быть пустым"
                              x-on:input="len = $event.target.value.length"
                              class="w-full h-32 border border-gray-300 rounded-lg px-3 py-2 resize-none max-h-48 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">{{ old('body') }}</textarea>
                    <div class="text-right text-xs text-gray-500 mt-0.5">
                        <span x-text="len"></span>/500
                    </div>
                    @error('body') <p class="text-red-600 text-xs">{{ $message }}</p>@enderror
                </div>

                {{-- Поля для ФЛ --}}
                <template x-if="category === 'individual'">
                    <div>
                        <label class="block font-medium text-gray-800 mb-1">
                            ФИО <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               name="fio"
                               required
                               pattern=".*\S.*"
                               title="Поле не может быть пустым"
                               value="{{ old('fio') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        @error('fio') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </template>

                {{-- Поля для ЮЛ --}}
                <template x-if="category === 'company'">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-gray-800 mb-1">
                                ИНН <span class="text-red-600">*</span>
                            </label>
                            <input type="text"
                                   name="inn"
                                   required
                                   pattern="\d{10}|\d{12}"
                                   title="10 или 12 цифр"
                                   value="{{ old('inn') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                            @error('inn') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-800 mb-1">
                                Контактное лицо <span class="text-red-600">*</span>
                            </label>
                            <input type="text"
                                   name="contact_name"
                                   required
                                   pattern=".*\S.*"
                                   title="Поле не может быть пустым"
                                   value="{{ old('contact_name') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                            @error('contact_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </template>

                {{-- Контакты --}}
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium text-gray-800 mb-1">
                            Телефон <span class="text-red-600">*</span>
                        </label>
                        <input name="phone"
                               required
                               x-ref="phone"
                               value="{{ old('phone', '+7 ') }}"
                               placeholder="+7 (___) ___-__-__"
                               @focus="ensurePrefix()"
                               @keydown="lockPrefix($event)"
                               @input.debounce.150ms="formatPhone($event)"
                               pattern="^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$"
                               title="+7 (XXX) XXX-XX-XX"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800 mb-1">
                            E-mail <span class="text-red-600">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               required
                               value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus;border-[#7BC043]">
                        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Повторное обращение --}}
                <div>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_repeat" value="1" x-model="isRepeat" class="accent-[#7BC043]">
                        <span class="text-sm">Это повторное обращение</span>
                    </label>
                </div>
                <template x-if="isRepeat">
                    <div>
                        <label class="block font-medium text-gray-800 mb-1">
                            Номер предыдущего обращения
                        </label>
                        <input type="text"
                               name="prev_number"
                               pattern="\d+"
                               title="Только цифры"
                               value="{{ old('prev_number') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#7BC043] focus:border-[#7BC043]">
                        @error('prev_number') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </template>

                {{-- Файлы --}}
                <div>
                    <label class="block font-medium text-gray-800 mb-1">
                        Приложить файлы
                        <span class="text-xs text-gray-500">(до 5 шт.; txt/jpg/png/zip/rar/doc/xls/pdf)</span>
                    </label>
                    <input type="file"
                           x-ref="uploader"
                           name="files[]"
                           multiple
                           accept=".txt,.jpg,.jpeg,.png,.zip,.rar,.doc,.docx,.xls,.xlsx,.pdf"
                           class="hidden">
                    <button type="button"
                            class="bg-[#7BC043] hover:bg-[#69af39] text-white font-medium px-6 py-2 rounded-full mb-3"
                            @click="$refs.uploader.click()">
                        Добавить файлы
                    </button>
                    <ul class="space-y-1 text-sm" x-show="files.length">
                        <template x-for="(file, i) in files" :key="i">
                            <li class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-md px-3 py-1">
                                <span class="truncate" x-text="file.name"></span>
                                <button type="button" class="text-red-600 hover:text-red-800 ml-3" @click="removeFile(i)">&times;</button>
                            </li>
                        </template>
                    </ul>
                    <p x-show="fileError" x-text="fileError" class="text-red-600 text-xs mt-1"></p>
                    @error('files') <p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <label class="inline-flex items-start gap-3 text-sm">
                    <input type="checkbox" name="consent" required class="mt-1 accent-[#7BC043]">
                    <span>
                        Я&nbsp;согласен(а) с&nbsp;
                        <a href="{{ url('privacy') }}"
                           target="_blank" rel="noopener"
                           class="underline text-[#7BC043] hover:text-[#69af39]">
                            политикой&nbsp;обработки&nbsp;персональных&nbsp;данных
                        </a>
                    </span>
                </label>
                @error('consent')
                <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror

                {{-- Кнопка отправки --}}
                <div class="pt-1 text-center">
                    <button class="w-full sm:w-auto bg-[#7BC043] hover:bg-[#69af39] text-white font-semibold px-8 py-2.5 rounded-full transition">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function appealForm() {
            return {
                category: '{{ old('category','individual') }}',
                isRepeat: {{ old('is_repeat') ? 'true' : 'false' }},
                showPolicy: false,
                files: [],
                fileError: '',

                init() {
                    this.$refs.uploader.addEventListener('change', e => this.addFiles(e));
                },

                ensurePrefix() {
                    const el = this.$refs.phone;
                    if (!el.value.startsWith('+7 ')) el.value = '+7 ';
                },

                lockPrefix(e) {
                    const el = this.$refs.phone;
                    const pos = el.selectionStart;
                    const svc = ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Home','End'];
                    if (svc.includes(e.key) || e.ctrlKey || e.metaKey) return;
                    if (['Backspace','Delete'].includes(e.key) && pos <= 3) {
                        e.preventDefault();
                        return;
                    }
                    if (!/\d/.test(e.key)) e.preventDefault();
                },

                formatPhone(event) {
                    const el = event.target;
                    let digits = el.value.replace(/\D/g,'');
                    if (digits.startsWith('7')) digits = digits.slice(1);
                    digits = digits.slice(0, 10);
                    const parts = digits.match(/(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
                    let res = '+7 ';
                    if (parts[1]) { res += '(' + parts[1] + (parts[1].length === 3 ? ') ' : ''); }
                    if (parts[2]) { res += parts[2] + (parts[2].length === 3 ? '-' : ''); }
                    if (parts[3]) { res += parts[3] + (parts[3].length === 2 ? '-' : ''); }
                    if (parts[4]) { res += parts[4]; }
                    el.value = res.trimEnd();
                },

                addFiles(e) {
                    this.fileError = '';
                    const allowed = ['txt','jpg','jpeg','png','zip','rar','doc','docx','xls','xlsx','pdf'];
                    const maxSize = 15 * 1024 * 1024;

                    for (const file of e.target.files) {
                        // Пропускаем дубликаты
                        const exists = this.files.some(f =>
                            f.name === file.name &&
                            f.size === file.size &&
                            f.lastModified === file.lastModified
                        );
                        if (exists) {
                            continue;
                        }
                        if (this.files.length >= 5) {
                            this.fileError = 'Нельзя прикрепить больше 5 файлов';
                            break;
                        }
                        const ext = file.name.split('.').pop().toLowerCase();
                        if (!allowed.includes(ext)) {
                            this.fileError = `Формат не поддерживается: .${ext}`;
                            continue;
                        }
                        if (file.size > maxSize) {
                            this.fileError = `Слишком большой файл: ${file.name}`;
                            continue;
                        }
                        this.files.push(file);
                    }
                    this.syncFileInput();
                },

                removeFile(i) {
                    this.files.splice(i, 1);
                    this.syncFileInput();
                },

                syncFileInput() {
                    const dt = new DataTransfer();
                    this.files.forEach(f => dt.items.add(f));
                    this.$refs.uploader.files = dt.files;
                }
            }
        }
    </script>
@endsection
