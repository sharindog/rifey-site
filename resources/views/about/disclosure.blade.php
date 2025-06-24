@extends('layouts.app')

@section('title', 'Раскрытие информации')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 text-gray-800">

            <h1 class="text-3xl font-bold text-green-600">Раскрытие информации</h1>
            <ul class="space-y-4">
                {{-- Решение о выпуске --}}
                <li class="flex items-center justify-between bg-white shadow p-4 rounded-2xl">
                    <span>Решение о выпуске ценных бумаг</span>
                    <a href="{{ asset('documents/disclosure/resolution.pdf') }}"
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

                {{-- Проспект ценных бумаг --}}
                <li class="flex items-center justify-between bg-white shadow p-4 rounded-2xl">
                    <span>Проспект ценных бумаг</span>
                    <a href="{{ asset('documents/disclosure/prospekt.pdf') }}"
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
            </ul>

        </div>
    </div>
@endsection
