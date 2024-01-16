@props(['color' => 'emerald'])

<a {{ $attributes->merge(['type' => 'button', 'class' => "inline-flex justify-center items-center px-4 py-2 bg-$color-300 border border-transparent rounded-md font-semibold text-xs text-gray-600 uppercase tracking-widest hover:bg-$color-200 active:bg-$color-500 focus:outline-none focus:border-$color-500 focus:shadow-outline-$color disabled:opacity-25 transition"]) }}>
    {{ $slot }}
</a>