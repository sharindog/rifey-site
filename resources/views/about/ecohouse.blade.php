@extends('layouts.app')

@section('title', 'Экодом')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-800 space-y-10">

            {{-- Заголовок --}}
            <h1 class="text-3xl font-bold text-green-600">Экодом</h1>

            {{-- Вводный блок --}}
            <p>
                По&nbsp;инициативе холдинговой компании «Экологические системы» (ООО&nbsp;«ХКЭС»)
                в&nbsp;Уральском федеральном округе создаётся сеть экодомов. Старт проекту был дан
                в&nbsp;2022&nbsp;году, сейчас участвуют Ханты-Мансийский&nbsp;АО, Тюменская и&nbsp;Свердловская области.
            </p>

            <p>
                Экодом&nbsp;— уникальный для России проект, пример совместной работы бизнеса, власти
                и&nbsp;жителей трёх регионов в&nbsp;повышении экологической культуры. В&nbsp;зоне ответственности
                ООО&nbsp;«Компания&nbsp;Рифей» действует экодом в&nbsp;парке «Народный» г.&nbsp;Нижний&nbsp;Тагил.
            </p>

            {{-- Фото-обложка --}}
            <div class="w-full overflow-hidden rounded-2xl shadow">
                <img src="{{ asset('images/ecohouse/cover.jpg') }}"
                     alt="Экодом в парке Народный"
                     class="w-full h-auto object-cover">
            </div>

            {{-- Цели проекта --}}
            <h2 class="text-2xl font-semibold mt-6">Цели работы сети экодомов</h2>
            <p>
                Экодом предоставляет жителям возможность гарантированной передачи отходов на&nbsp;переработку
                и&nbsp;свободный доступ к&nbsp;знаниям о&nbsp;современных подходах в&nbsp;сфере обращения с&nbsp;отходами.
            </p>

            {{-- Что принимают / Куда идёт (две фото в ряд) --}}
            <div class="grid sm:grid-cols-2 gap-4 mt-6">
                <img src="{{ asset('images/ecohouse/accept.jpg') }}"
                     alt="Приём вторсырья"
                     class="rounded-xl shadow w-full h-auto object-cover">

                <img src="{{ asset('images/ecohouse/process.jpg') }}"
                     alt="Переработка вторсырья"
                     class="rounded-xl shadow w-full h-auto object-cover">
            </div>

            <p class="mt-6">
                Мы принимаем только то, что действительно перерабатывается. Посетители могут выбрать:
                принести отходы в&nbsp;экодом или сдать в&nbsp;специализированные пункты.
                Всё собранное сырьё гарантированно уходит на&nbsp;переработку; средства от&nbsp;его реализации
                идут на&nbsp;развитие площадок и&nbsp;эко-образовательные мероприятия.
            </p>

            {{-- Экодом как точка притяжения --}}
            <h2 class="text-2xl font-semibold mt-6">Экодом как точка притяжения</h2>
            <p>
                Здесь вторичные отходы обретают новый смысл, а&nbsp;гости узнают, как организовать
                раздельный сбор дома и&nbsp;заменить одноразовые вещи многоразовыми аналогами.
            </p>

            {{-- Две фото в ряд --}}
            <div class="grid sm:grid-cols-2 gap-4 mt-6">
                <img src="{{ asset('images/ecohouse/inside1.jpg') }}"
                     alt="Интерьер экодома"
                     class="rounded-xl shadow w-full h-auto object-cover">

                <img src="{{ asset('images/ecohouse/inside2.jpg') }}"
                     alt="Зона обучения"
                     class="rounded-xl shadow w-full h-auto object-cover">
            </div>

            {{-- Функциональные зоны --}}
            <div class="space-y-4 mt-6">
                <h3 class="text-xl font-semibold text-green-700">Учебная зона</h3>
                <p>Презентации, экоуроки, мастер-классы, 3D-экскурсии на&nbsp;МСК, экологический диктант.</p>

                <h3 class="text-xl font-semibold text-green-700">Мягкая зона</h3>
                <p>Место для встреч единомышленников, просмотров фильмов, чтения.</p>

                <h3 class="text-xl font-semibold text-green-700">Игровая зона</h3>
                <p>Экологические игры, выставки, благотворительные мероприятия.</p>
            </div>

            {{-- Контакты --}}
            <div class="mt-8 bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-semibold text-green-700">Запись и консультации</h3>
                <p>Экодом «Народный», Нижний&nbsp;Тагил</p>
                <p class="font-medium">Телефон: <a href="tel:+79827311428" class="text-green-600 hover:underline">+7&nbsp;982&nbsp;731-14-28</a></p>
            </div>

            {{-- Финальная фотография --}}
            <div class="mt-6 w-full overflow-hidden rounded-2xl shadow">
                <img src="{{ asset('images/ecohouse/finale.jpg') }}"
                     alt="Экодом вечером"
                     class="w-full h-auto object-cover">
            </div>
        </div>
    </div>
@endsection
