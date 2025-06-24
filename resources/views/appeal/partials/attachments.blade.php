@php($files = $attachments ?? collect())

<div class="pt-3">
    @if ($files->isEmpty())
        <p class="text-sm text-gray-500">Вложения отсутствуют.</p>
    @else
        <ul class="space-y-1">
            @foreach ($files as $file)
                <li class="flex items-center gap-2 text-sm">
                    <x-orchid-icon path="paperclip" class="w-4 h-4 text-gray-500"/>
                    <a href="{{ $file->url }}" target="_blank"
                       class="hover:text-primary transition">
                        {{ $file->original_name }}
                    </a>
                    <span class="text-xs text-gray-500">
                        ({{ number_format($file->size/1024,1) }} КБ)
                    </span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
