@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <h1 class="text-3xl font-bold text-gray-900">Контакты</h1>

            {{-- Карточка: Общая информация --}}
            <div class="bg-white shadow rounded-2xl p-6 space-y-4">
                <h2 class="text-xl font-semibold text-green-600">ООО "Компания "РИФЕЙ"</h2>
                <p><strong>Юридический адрес:</strong><br>
                    622001, Свердловская область,<br>
                    г. Нижний Тагил,<br>
                    тракт Черноисточинский, д.14, пом.17
                </p>
                <p><strong>Региональный оператор по обращению с ТКО</strong></p>
            </div>

            {{-- Карточка: Горячие линии --}}
            <div class="bg-white shadow rounded-2xl p-6 space-y-4">
                <h2 class="text-xl font-semibold text-green-600">Горячие линии</h2>
                <p><strong>Телефон:</strong><br>
                    8-800-234-02-43<br>
                    +7-3435-363-377
                </p>
                <p><strong>Email:</strong>
                    <a href="mailto:rifey-apo1@mail.ru" class="text-green-600 hover:underline">rifey-apo1@mail.ru</a>
                </p>
                <p><strong>Вопросы по договорам и расчётам:</strong></p>
                <ul class="list-disc list-inside ml-4">
                    <li><strong>Юридические лица:</strong> 8-800-234-66-48</li>
                    <li><strong>Физические лица:</strong> 8-800-250-32-42</li>
                </ul>
            </div>

            {{-- Карточка: РИЦ --}}
            <div class="bg-white shadow rounded-2xl p-6 space-y-4">
                <h2 class="text-xl font-semibold text-green-600">АО "РИЦ"</h2>
                <p><strong>Сайт:</strong>
                    <a href="https://ricso.ru/" target="_blank" class="text-green-600 hover:underline">https://ricso.ru/</a>
                </p>
                <p><strong>Email:</strong>
                    <a href="mailto:info@ricso.ru" class="text-green-600 hover:underline">info@ricso.ru</a>
                </p>
                <p><strong>График выездных специалистов:</strong><br>
                    <a href="https://lyl.su/Y7A7" target="_blank" class="text-green-600 hover:underline">
                        https://lyl.su/Y7A7
                    </a>
                </p>
            </div>

            {{-- Карточка: Центры обслуживания клиентов --}}
            <div class="bg-white shadow rounded-2xl p-6 space-y-4">
                <h2 class="text-xl font-semibold text-green-600">Центры обслуживания клиентов</h2>
                <ul class="list-disc list-inside ml-4">
                    <li><strong>г. Нижний Тагил:</strong> ул. Черноисточинский тракт, д. 14 Б</li>
                    <li>ул. Окунева, д. 22 (1 этаж)</li>
                    <li>ул. Красная, д. 20 (2 этаж)</li>
                    <li>ул. Красноармейская, д. 60 (АО «НТСК»)</li>
                    <li><strong>г. Нижняя Тура:</strong> ул. 40 лет Октября, д. 7</li>
                    <li><strong>г. Серов:</strong> ул. Р. Люксембург, д. 6</li>
                    <li><strong>г. Краснотурьинск:</strong> ул. Чкалова, д. 45</li>
                    <li><strong>г. Североуральск:</strong> ул. Ленина, д. 7</li>
                    <li><strong>г. Невьянск:</strong> ул. М. Горького, д. 7а</li>
                    <li><strong>г. Кушва:</strong> ул. Октябрьская, д. 9</li>
                    <li><strong>п. Баранчинский:</strong> ул. Республики, д. 7</li>
                    <li><strong>пгт. Пелым:</strong> ул. Строителей, д. 9</li>
                </ul>
            </div>

            {{-- Карточка: Пресс-служба --}}
            <div class="bg-white shadow rounded-2xl p-6 space-y-4">
                <h2 class="text-xl font-semibold text-green-600">Для представителей СМИ</h2>
                <p><strong>Телефон:</strong><br>
                    +7 (3435) 36-33-77 (доб. 2278)
                </p>
                <p><strong>Email:</strong>
                    <a href="mailto:pressa-rifey@mail.ru" class="text-green-600 hover:underline">pressa-rifey@mail.ru</a>
                </p>
            </div>
        </div>
    </div>
@endsection
