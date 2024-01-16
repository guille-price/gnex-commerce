<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <p class="mt-8 text-lg font-medium">Metodos de Envio</p>
        <form class="mt-5 grid gap-6">
            @foreach ($carriers as $carrier)
                <div class="relative">
                    <input class="peer hidden" id="radio_{{$loop->iteration}}" type="radio" name="radio" checked />
                    <span
                        class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                        for="radio_{{$loop->iteration}}">
                        <img class="w-14 object-contain" src="{{$carrier['logo']}}" alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">{{ $carrier['description'] }}</span>
                            <p class="text-slate-500 text-sm leading-6">Entrega Estimada: {{ $carrier['delivery_estimate'] }}</p>
                        </div>
                    </label>
                </div>
            @endforeach
            
        </form>        

        {{-- @livewire('category-filter', ['category' => $category]) --}}
    </div>

</x-app-layout>
