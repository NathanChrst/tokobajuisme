@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring focus:ring-terracotta focus:ring-opacity-50 shadow-sm transition duration-150 ease-in-out']) !!}>
