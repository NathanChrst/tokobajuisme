<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-red-600/90 hover:bg-red-600 text-white font-semibold rounded-xl shadow-lg shadow-red-600/20 hover:shadow-red-600/40 border border-red-500/30 transition-all duration-200 cursor-pointer disabled:opacity-50']) }}>
    {{ $slot }}
</button>
