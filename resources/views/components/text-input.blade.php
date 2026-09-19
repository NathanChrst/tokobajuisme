@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full rounded-xl bg-[#121218] border border-[#232336] text-slate-100 placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-inner transition duration-150 ease-in-out disabled:opacity-50 disabled:bg-[#0A0A0F]']) !!}>
