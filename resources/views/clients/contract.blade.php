@extends('layouts.app')

@section('title', 'Заключение договора на обращение с ТКО')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-800 space-y-10">

            {{-- Заголовок --}}
            <h1 class="text-3xl font-bold text-green-600">
                Заключение договора на&nbsp;обращение с&nbsp;ТКО
            </h1>

            <div class="space-y-6 leading-relaxed">

                <p>
                    С&nbsp;2019&nbsp;года услуга по&nbsp;вывозу мусора перешла из&nbsp;категории жилищных в&nbsp;коммунальные.
                    То&nbsp;есть сбор и&nbsp;вывоз отходов исключён из&nbsp;единой графы «содержание общего имущества»;
                    вместо этого потребители получают отдельные платёжные документы.
                </p>

                <p>
                    Размер платы определяется нормативами накопления ТКО и&nbsp;утверждёнными тарифами
                    регионального оператора. Нормативы устанавливает Министерство энергетики и&nbsp;ЖКХ
                    Свердловской области, а&nbsp;предельный тариф&nbsp;— Региональная энергетическая комиссия.
                </p>

                <p>
                    Для населения плата рассчитывается исходя из&nbsp;числа постоянно и&nbsp;временно
                    проживающих в&nbsp;квартире. Для юридических лиц, имеющих собственные ёмкости,
                    предусмотрены два варианта: по&nbsp;нормативу либо по&nbsp;объёму контейнеров.
                </p>

                <p>
                    Заключить договор с&nbsp;регоператором обязаны все&nbsp;— физлица, юрлица, ИП.
                    Отсутствие договора с&nbsp;1&nbsp;января&nbsp;2019&nbsp;г. влечёт ответственность,
                    поскольку договоры с&nbsp;прежними перевозчиками утратили силу 31 декабря 2018 года.
                </p>

                <p>
                    Агентом по&nbsp;заключению договоров, начислению и&nbsp;сбору платежей
                    в&nbsp;Северном&nbsp;АПО-1 выбран <strong>АО&nbsp;«Региональный информационный центр»</strong>.
                    Подробности <a href="https://ricso.ru/" class="text-green-600 hover:underline">на сайте АО РИЦ</a>.
                </p>

                <h2 class="text-xl font-semibold text-green-700 mt-6">Порядок заключения договора</h2>

                <p>
                    7&nbsp;декабря&nbsp;2018&nbsp;года на&nbsp;сайте регоператора размещено предложение
                    о&nbsp;заключении договора. В&nbsp;течение 15&nbsp;рабочих дней после публикации
                    потребитель направляет заявку и&nbsp;пакет документов.
                </p>

                <p>
                    Физическим лицам письменная форма не&nbsp;обязательна; юридические лица и&nbsp;ИП
                    заключают договор в&nbsp;письменном виде.
                </p>

                <h2 class="text-xl font-semibold text-green-700">Консультационные линии</h2>

                <ul class="list-disc pl-5 space-y-2">
                    <li>бесплатный телефон&nbsp;для физических лиц: <strong>8&nbsp;800&nbsp;250-32-42</strong></li>
                    <li>бесплатный телефон&nbsp;для юридических лиц: <strong>8&nbsp;800&nbsp;234-66-48</strong></li>
                </ul>

                <p>
                    Комплект документов юрлица могут подать очно или по&nbsp;почте
                    в&nbsp;офисах АО&nbsp;«РИЦ». Адреса офисов указаны в&nbsp;разделе
                    «<a href="{{ route('contacts') }}" class="text-green-600 hover:underline">Контакты</a>».
                </p>

            </div>


            {{-- =====  ДОКУМЕНТЫ  ======================================================= --}}
            <h2 class="text-2xl font-semibold mt-12">Документы для скачивания</h2>

            @php  // массив «категория → список документов»
            $docs = [
                'Общие' => [
                    ['Форма типового договора на оказание услуги по обращению с ТКО (утв. Постановлением Правительства РФ от 12.11.2016 №1156), заключаемая без письменной формы',                               'common/forma_tipovogo_dogovora_na_okazanie_uslug_po_obrashcheniiu_s_tko_utv__po.pdf'],
                ],

                'Документы для физических лиц' => [
                    ['Перечень документов для заключения договора',                                             'phys/fizlica.pdf'],
                    ['Форма письма о&nbsp;предоставлении информации',                                           'phys/forma_pis_ma_potrebiteliam_o_predostavlenii_informatcii.doc'],
                    ['Пример схемы размещения ПН',                                                              'phys/primer_skhemy_razmeshcheniia_pn.pdf'],
                    ['Согласие на&nbsp;обработку персональных данных',                                          'phys/soglasie_potrebitelia_na_obrabotku_personal_nykh_dannykh.docx'],
                    ['Заявка на&nbsp;заключение договора (физлица)',                                            'phys/zaiavka_na_zakliuchenie_dogovora_f_litca.xls'],
                    ['Форма договора (физлица / юрлица — собственники нежилых помещений)',                      'phys_contracts/dogovor_fl_i_iul_nezhilye_iul_fl_proch-1.pdf'],
                    ['Форма договора (физлица&nbsp;— жилые помещения в&nbsp;МКД/ИЖД)',                          'phys_contracts/dogovor_tko_s_fl_mkd_izhf-1.pdf'],
                ],

                'Документы для юридических лиц' => [
                    ['Заявка на&nbsp;заключение договора (нежилое помещение)',                                  'legal/prilozhenie_anketa_potrebitelia.xlsx'],
                    ['Перечень документов для заключения договора',                                             'legal/urlica.pdf'],
                    ['Форма письма о&nbsp;предоставлении информации',                                           'legal/forma_pis_ma_potrebiteliam_o_predostavlenii_informatcii.doc'],
                    ['Пример схемы размещения ПН',                                                              'legal/primer_skhemy_razmeshcheniia_pn.pdf'],
                    ['Согласие на&nbsp;обработку персональных данных',                                          'legal/soglasie_na_obrabotku_personal_nykh_dannykh.docx'],
                    ['Договор (физ/юр.&nbsp;лица&nbsp;— нежилые помещения, бюджетные потребители)',             'legal/dogovor_fl_i_iul_nezhilye_iul_fl_proch-1.pdf'],
                    ['Форма договора для юридического лица - собственника/владельца жилого помещения, комнаты в МКД, жилого дома, заключаемая в письменной форме)',                                'legal/dogovor_tko_s_iul_mkd_izhf-1.pdf'],
                    ['Договор (юр.&nbsp;лицо&nbsp;— нежилое помещение, 223-ФЗ)',                                 'legal/dogovor_iul_po_223-fz_nezhiloe_pomeshchenie-1.pdf'],
                    ['Договор (юр.&nbsp;лицо&nbsp;— нежилое помещение, 44-ФЗ)',                                 'legal/dogovor_biudzhet_44-fz-1.pdf'],
                    ['Договор (юр.&nbsp;лицо&nbsp;— исполнитель коммунальной услуги: ГСК, СНТ)',               'legal/dogovor_snt_gsk-1.pdf'],
                ],

                'Документы для перерасчётов' => [
                    ['Заявление о&nbsp;неиспользовании нежилого помещения (физлица)',                            'recalc/zaiavlenie_o_neispol_zovanii_nezhilogo_pomeshchenii_fl.docx'],
                    ['Заявление о&nbsp;неиспользовании нежилого помещения (юрлица)',                             'recalc/zaiavlenie_o_neispol_zovanii_nezhilogo_pomeshcheniia_iul.docx'],
                    ['Заявление на&nbsp;перерасчёт (приостановка деятельности юрлица)',                          'recalc/zaiavlenie_na_pereraschet_priostanovka_deiatel_nosti.xlsx'],
                    ['Заявление на&nbsp;перерасчёт (ненадлежащее качество услуги)',                              'recalc/zaiavlenie_na_pereraschet_neokazanie_uslugi.xlsx'],
                    ['Заявление о&nbsp;способе доставки корреспонденции',                                        'recalc/zaiavlenie_o_sposobe_dostavki_korrespondentcii.xlsx'],
                ],
            ];
            @endphp

            {{-- Выводим категории и их файлы --}}
            @foreach($docs as $group => $items)
                <h3 class="text-xl font-semibold mt-8">{{ $group }}</h3>

                <ul class="space-y-3 mt-2">
                    @foreach($items as [$title, $file])
                        <li class="flex items-center justify-between bg-white shadow p-4 rounded-2xl">
                            <span class="leading-snug">{!! $title !!}</span>
                            <a href="{{ asset('documents/contract/' . $file) }}"
                               download
                               class="inline-flex items-center gap-2 text-green-600 hover:text-green-800">
                                <!-- Heroicons download -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 flex-shrink-0"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16"/>
                                </svg>
                                <span>Скачать</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
            {{-- === CTA: подать заявку =============================== --}}
            <div class="mt-12 text-center">
                <a href="{{ route('appeal.create') }}"
                   class="inline-block px-10 py-4 bg-green-600 hover:bg-green-700
              text-white text-lg font-semibold rounded-full shadow-lg transition">
                    Подать заявку на&nbsp;заключение договора
                </a>
            </div>

        </div>
    </div>
@endsection
