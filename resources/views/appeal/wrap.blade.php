<div class="appeal-screen">
    {{--  Orchid может назвать переменную по-разному  --}}
    {!! $template
        ?? ($slot    ?? null)
        ?? ($layout  ?? null)
        ?? ($content ?? null)
        ?? ($render  ?? null)
        ?? '' !!}
</div>
