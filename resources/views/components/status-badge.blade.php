@props(['status', 'color' => 'gray'])

@php
$colorClasses = match ($color) {
    'emerald' => 'bg-emerald-950/60 text-emerald-400 border-emerald-800/60',
    'red' => 'bg-red-950/60 text-red-400 border-red-800/60',
    'amber' => 'bg-amber-950/60 text-amber-400 border-amber-800/60',
    'blue' => 'bg-blue-950/60 text-blue-400 border-blue-800/60',
    'indigo' => 'bg-indigo-950/60 text-indigo-400 border-indigo-800/60',
    'purple' => 'bg-purple-950/60 text-purple-400 border-purple-800/60',
    'terracotta' => 'bg-blue-950/60 text-blue-400 border-blue-800/60',
    default => 'bg-[#161622] text-slate-300 border-[#232336]',
};
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $colorClasses }}">
    {{ $status }}
</span>
