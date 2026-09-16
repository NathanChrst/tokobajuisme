<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-red-500 text-white font-semibold rounded-xl shadow-sm hover:bg-red-600 transition-all duration-300']) }}>
    {{ $slot }}
</button>
