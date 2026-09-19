<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-[#161622] border border-[#232336] text-slate-200 font-semibold rounded-xl shadow-sm hover:bg-[#1E1E2D] hover:text-white hover:border-blue-500/50 transition-all duration-200 cursor-pointer disabled:opacity-50']) }}>
    {{ $slot }}
</button>
