@props(['color' => 'emerald'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex justify-center items-center px-4 py-2 rounded-md uppercase tracking-widest bg-emerald-300 bg-none text-center text-xs font-bold text-gray-600 transition-all duration-200 ease-in-out focus:shadow hover:bg-green-200"]) }}>
    {{ $slot }}
</button>