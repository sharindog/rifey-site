@extends('layouts.app')

@section('title', 'Графики вывоза ТКО')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-800 space-y-10">

            {{-- ── заголовок --}}
            <h1 class="text-3xl font-bold text-green-600">Графики вывоза ТКО</h1>

            {{-- ── пояснительный текст --}}
            <div class="space-y-6 leading-relaxed">
                <p>Региональный оператор по обращению с твёрдыми коммунальными отходами в АПО №1 Свердловской области ООО «Компания «РИФЕЙ» выбрал на конкурсной основе организации, которые занимаются сбором и транспортированием твердых коммунальных отходов в зоне ответственности. Все подрядчики имеют лицензию на осуществление сбора, транспортирования, обработки, утилизации, обезвреживания и размещения отходов первого — четвёртого классов опасности, в собственности (или на ином основании), у них достаточное количество мусоровозов, причем вся техника оснащается системой спутниковой навигации для передачи данных региональному оператору в режиме реального времени: для контроля за перемещением транспорта и фиксации длины пробега.</p>
                <p>От населения, юридических лиц и индивидуальных предпринимателей региональным оператором вывозятся только твердые коммунальные, а также крупногабаритные отходы. К последним относятся пришедшие в негодность предметы домашнего обихода большого размера – шкафы, диваны, матрасы, крупная бытовая техника и т.д. Самостоятельная доставка ТКО на полигон собственниками отходов не требуется.</p>
                <p>Обращаем Ваше внимание, что услуга по обращению с ТКО не распространяется на сбор и вывоз строительного мусора, образовавшегося в ходе капитальных ремонтных или строительных работ. Собственники отходов, не подпадающих под понятие ТКО, обязаны самостоятельно обеспечить его размещение на полигоне. Собственник может оформить заявку на вывоз отходов и заключить договор с любой компанией, которая вправе осуществлять эту деятельность.</p>
                <p>Обслуживание контейнерных площадок производится согласно СанПиН 2.1.3684-21 «Санитарно-эпидемиологические требования к содержанию территорий городских и сельских поселений, к водным объектам, питьевой воде и питьевому водоснабжению, атмосферному воздуху, почвам, жилым помещениям, эксплуатации производственных, общественных помещений, организации и проведению санитарно-противоэпидемических (профилактических) мероприятий».</p>

                <p>
                    С реестром контейнерных площадок вы можете ознакомиться на сайтах администраций
                    муниципалитетов:
                </p>

                {{-- ── таблица ссылок администраций (23 МО) --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <tbody class="divide-y divide-gray-200">

                        @php
                            $links = [
                                // строка 1
                                ['МО город Нижний Тагил' , 'https://ntagil.org/eko/tko/reestr/'],
                                ['Серовский МО'           , 'https://www.adm-serov.ru/index.php?page_link=okrug_jkx_tko'],
                                ['Новолялинский МО'       , 'https://ngo.midural.ru/article/show/id/11048'],
                                // строка 2
                                ['ГО город Лесной'        , 'http://www.gorodlesnoy.ru/about/info/projects/10799/'],
                                ['МО Краснотурьинск'      , 'http://xn----7sbbqrkctdbjvdlfmr7n.xn--p1ai/gorodskaya-sreda/zhkkh/obrashchenie-s-tko/'],
                                ['МО Красноуральск'       , 'https://krur.midural.ru/article/show/id/10022'],
                                // строка 3
                                ['Верхнесалдинский МО'    , 'http://v-salda.ru/gorodskaya-sreda/ekologiya/reestr-ploshchadok-tko/index.php'],
                                ['Ивдельский МО'          , 'https://admivdel.ru/tekushhaya-deyatelnost/obrashchenie-s-tverdymi-kommunalnymi-otkhodami-tko/27474-reestr-kontejnernykh-ploschadok-na-territorii-ivdelskogo-go'],
                                ['Гаринский МО'           , 'http://admgari-sever.ru/communal/gkh/gkhopenkonkurses/'],
                                // строка 4
                                ['ГО Верхняя Тура'        , 'https://www.v-tura.ru/category/tko'],
                                ['МО Верхотурский'        , 'https://adm-verhotury.ru/gorodskaya-sreda/ecology/obraschenie-s-tko/'],
                                ['Волчанский МО'          , 'https://volchansk-adm.ru/communal/ecology/ecologycleaning/'],
                                // строка 5
                                ['МО Карпинск'            , 'https://karpinsk.midural.ru/article/show/id/10266'],
                                ['Качканарский МО'        , 'https://kgo66.ru/gkh/gkh-eco/str-ogtis-eco-tko#reestr-mest-tko'],
                                ['Кушвинский МО'          , 'https://kushva.midural.ru/article/show/id/10293'],
                                // строка 6
                                ['Невьянский МО'          , 'https://nevyansk66.ru/obraschenie-s-tverdyimi-kommunalnyimi-othodami/'],
                                ['МО Нижняя Салда'        , 'https://nsaldago.ru/communal/reforma-tko/#mo-element-region-reestr-mest-nakopleniya-ploschadok-tverdyih-kommunalnyih-othodov-na-territorii-munitsipalnogo-okruga-nizhnyaya-salda'],
                                ['Нижнетуринский МО'      , 'https://ntura.midural.ru/document/category/79#document_list'],
                                // строка 7
                                ['Североуральский МО'     , 'http://adm-severouralsk.ru/communal/ekologiya/#mo-element-region-obraschenie-s-othodami'],
                                ['МО Пелым'               , 'https://go.pelym-adm.info/edit-blog/99-informatsiya-dlya-naseleniya/vyvoz-tbo/1402-%D1%80%D0%B5%D0%B5%D1%81%D1%82-%D0%BA%D0%BE%D0%BD%D1%82%D0%B5%D0%B9%D0%BD%D0%B5%D1%80%D0%BD%D1%8B%D1%85-%D0%BF%D0%BB%D0%BE%D1%89%D0%B0%D0%B4%D0%BE%D0%BA-%D0%BC%D0%B5%D1%81%D1%82-%D0%BD%D0%B0%D0%BA%D0%BE%D0%BF%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F-%D1%82%D0%BA%D0%BE-%D0%BD%D0%B0-%D1%82%D0%B5%D1%80%D1%80%D0%B8%D1%82%D0%BE%D1%80%D0%B8%D0%B8-%D0%B3%D0%BE%D1%80%D0%BE%D0%B4%D1%81%D0%BA%D0%BE%D0%B3%D0%BE-%D0%BE%D0%BA%D1%80%D1%83%D0%B3%D0%B0-%D0%BF%D0%B5%D0%BB%D1%8B%D0%BC.html'],
                                ['ГО ЗАТО Свободный'      , 'http://xn----7sbbeejeuwxribb5bo5n.xn--p1ai/%D0%B4%D0%B5%D1%8F%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D0%BE%D1%81%D1%82%D1%8C/%D0%B0%D0%BA%D1%82%D1%8B/2025/index.php'],
                                // строка 8
                                ['Горноуральский МО'      , 'https://grgo.ru/sreda/uslugi-tko.php?SECTION_ID=1656&ELEMENT_ID=42265'],
                                ['Сосьвинский МО'         , 'http://adm-sosva.ru/gkh/tko/#mo-element-region-reestr-kontejnernyih-ploschadok-na-territorii-sosvinskogo-gorodskogo-okruga'],
                            ];
                        @endphp

                        @foreach($links as $index => [$label, $href])
                            @if($index % 3 === 0)<tr class="divide-x divide-gray-200">@endif
                                <td class="py-1 px-2 whitespace-nowrap">
                                    <a href="{{ $href }}" target="_blank" class="text-green-600 hover:underline">
                                        {{ $label }}
                                    </a>
                                </td>
                                @if($index % 3 === 2)</tr>
                            @endif
                            @endforeach
                            @if(count($links) % 3 !== 0)
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── CTA-кнопка --}}
            <div class="text-center mt-10">
                <a href="{{ route('appeal.create') }}"
                   class="inline-block px-10 py-4 bg-green-600 hover:bg-green-700
                      text-white text-lg font-semibold rounded-full shadow-lg transition">
                    Подать заявку на&nbsp;вывоз ТКО
                </a>
            </div>

            {{-- ── список графиков (оставьте существующий цикл) --}}
            @foreach($groups as $municipality => $cats)
                <h2 class="text-2xl font-semibold mt-12">{{ $municipality }}</h2>
                <ul class="space-y-4 mt-4">
                    @foreach($cats->flatMap->documents as $doc)
                        <li class="flex items-center justify-between bg-white shadow p-4 rounded-2xl">
                            <span>{{ $doc->title }}</span>
                            <a href="{{ $doc->attachment->url() }}"
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

        </div>
    </div>
@endsection
