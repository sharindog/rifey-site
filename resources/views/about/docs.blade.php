@extends('layouts.app')

@section('title', 'Документы')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 text-gray-800">
            <h1 class="text-3xl font-bold text-green-600">Документы</h1>
            <p class="text-base text-gray-700">
                В этом разделе собраны актуальные нормативно-правовые документы в области обращения с отходами, а также другая полезная информация.
            </p>

            @foreach($categories as $category)
                <h2 class="text-2xl font-semibold mt-8">{{ $category->title }}</h2>
                <ul class="space-y-2">
                    @foreach($category->documents as $doc)
                        <li class="flex justify-between items-center bg-white shadow p-4 rounded-2xl">
                            <span>{{ $doc->title }}</span>

                            @if($doc->attachment)
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
                            @else
                                <span class="text-gray-400">Нет файла</span>
                            @endif

                        </li>
                    @endforeach
                </ul>
            @endforeach

        </div>
    </div>
@endsection
