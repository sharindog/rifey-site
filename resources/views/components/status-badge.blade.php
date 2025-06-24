@php
    // цветовая карта
    $map = [
        'new'      => 'bg-gray-200 text-gray-800',
        'in_work'  => 'bg-yellow-200 text-yellow-900',
        'answered' => 'bg-green-200 text-green-900',
        'closed'   => 'bg-slate-300 text-slate-900',
    ];
    $text = [
        'new'      => 'Новое',
        'in_work'  => 'В работе',
        'answered' => 'Ответ дан',
        'closed'   => 'Закрыто',
    ];
    $class = $map[$status] ?? 'bg-gray-200 text-gray-800';
@endphp

<span class="inline-block px-3 py-0.5 rounded-full text-xs font-semibold {{$class}}">
    {{ $text[$status] ?? $status }}
</span>
