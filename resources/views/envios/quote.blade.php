<x-app-layout>

    <div class="bg-white max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <p class="mt-4 text-lg font-medium">Metodos de Envio</p>
        <form class="mt-2 grid gap-3">
            @foreach ($carriers as $carrier)
                <div class="relative">
                    <input class="peer hidden" id="radio_{{ $loop->iteration }}" value="{{$carrier['total_pricing']}}" type="radio" name="radio" />
                    <span
                        class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-2"
                        for="radio_{{ $loop->iteration }}">
                        
                        <img class="w-20 object-contain"
                            src="{{ url('storage/img/carriers/'.$carrier['provider'].'.svg') }}"
                            alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">{{ $carrier['service_level_name'] }}</span>
                            <p class="text-slate-500 text-sm leading-6">Entrega Estimada:
                                {{ $carrier['days'] }} Dias</p>
                            @if ($carrier['extra_dimension_price'] > 0 || $carrier['out_of_area_pricing'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Costo Guia: {{ $carrier['amount_local'] }}</p>
                            @endif
                            @if ($carrier['extra_dimension_price'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Cargos Adicionales de la Paqueteria:
                                    {{ $carrier['extra_dimension_price'] }}</p>
                            @endif
                            @if ($carrier['out_of_area_pricing'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Zona Extendida:
                                    {{ $carrier['out_of_area_pricing'] }}</p>
                            @endif
                            <p class="text-slate-800 text-sm leading-6">Costo Total Envio: {{ $carrier['total_pricing'] }}</p>
                        </div>
                    </label>
                </div>
            @endforeach

        </form>

        {{-- @livewire('category-filter', ['category' => $category]) --}}
    </div>

</x-app-layout>
