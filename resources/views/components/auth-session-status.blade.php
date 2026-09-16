@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-emerald-50 text-emerald-700 p-3 rounded-xl text-sm font-medium']) }}>
        {{ $status }}
    </div>
@endif
