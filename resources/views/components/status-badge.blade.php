@props(['status', 'color' => 'gray'])

@php
$colorClasses = match ($color) {
    'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'red' => 'bg-red-50 text-red-700 border-red-200',
    'amber' => 'bg-amber-50 text-amber-700 border-amber-200',
    'blue' => 'bg-blue-50 text-blue-700 border-blue-200',
    'indigo' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
    'purple' => 'bg-purple-50 text-purple-700 border-purple-200',
    'terracotta' => 'bg-[#E07A5F]/10 text-[#E07A5F] border-[#E07A5F]/20',
    default => 'bg-gray-50 text-gray-700 border-gray-200',
};
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $colorClasses }}">
    {{ $status }}
</span>
