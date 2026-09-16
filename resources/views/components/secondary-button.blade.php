<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-300']) }}>
    {{ $slot }}
</button>
