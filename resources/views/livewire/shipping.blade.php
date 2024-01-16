<div x-data>
    <div class="bg-white rounded-lg shadow p-4">
        {{-- <div wire:loading>
            <p class="text-gray-700 text-md">Cargando Opciones de Envio... </p>
        </div>

        <div wire:loading
            class="w-8 h-8 animate-spin rounded-full bg-gradient-to-r from-yeonhi via-yeonhi-st to-yeonhi-gl">
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-gray-200 rounded-full border-2 border-white">
                <img src="{{ Storage::url('img/logo.png') }}">
            </div>
        </div> --}}

        <p class="mt-2 text-lg font-medium">Estimaciones de Costos de Envio </p>
        <p class="mt-2 text-gray-600 text-sm">Al proporcionar tu Codigo Postal te daremos las mejores opciones de envio
            para
            tu localidad </p>

        <div class="mt-2 grid gap-2">
            @foreach ($carriers as $carrier)
                <div class="relative">
                    {{-- <input class="peer hidden" id="radio_shipp{{ $loop->iteration }}"
                            value="{{ $carrier['total_pricing'] }}" type="radio" name="radio_ship"
                            wire:click="shippingCost('{{ $carrier['total_pricing'] }}', '{{ $carrier['provider'] }}', '{{ $carrier['service_level_name'] }}')" /> --}}
                    <input class="peer hidden" id="radio_shipp{{ $loop->iteration }}" value="{{ $carrier['total_pricing'] }}"
                        type="radio" name="radio_ship" wire:click="shippingCost('{{ $carrier['total_pricing'] }}', '{{ $carrier['provider'] }}', '{{ $carrier['service_level_name'] }}')" />
                    <span
                        class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-2"
                        for="radio_shipp{{ $loop->iteration }}">

                        <img class="w-16 object-contain"
                            src="{{ url('storage/img/carriers/' . $carrier['provider'] . '.svg') }}" alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">{{ $carrier['service_level_name'] }} al Codigo Postal: {{ $zip_code }}</span>
                            <p class="text-slate-500 text-sm leading-6">Entrega Estimada:
                                {{ $carrier['days'] }} Dias</p>
                            @if ($carrier['extra_dimension_price'] > 0 || $carrier['out_of_area_pricing'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Costo Guia:
                                    {{ $carrier['amount_local'] }}</p>
                            @endif
                            @if ($carrier['extra_dimension_price'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Cargos Adicionales de la
                                    Paqueteria:
                                    {{ $carrier['extra_dimension_price'] }}</p>
                            @endif
                            @if ($carrier['out_of_area_pricing'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Zona Extendida:
                                    {{ $carrier['out_of_area_pricing'] }}</p>
                            @endif
                            <p class="text-slate-800 text-sm leading-6">Costo Total Envio:
                                {{ $carrier['total_pricing'] }}
                            </p>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>


        {{-- Funciona en Rate ShippingController --}}
        {{-- <form class="mt-2 grid gap-6">
            @foreach ($carriers as $carrier)
                <div class="relative">
                    <input class="peer hidden" id="radio_shipp{{$loop->iteration}}" type="radio" name="radio_ship" />
                    <span
                        class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-2"
                        for="radio_shipp{{$loop->iteration}}">
                        <img class="w-20 object-contain" src="{{ url('storage/img/carriers/' . $carrier['provider'] . '.svg') }}" alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">{{ $carrier['service_level_name'] }}</span>
                            <p class="text-slate-500 text-sm leading-6">Entrega Estimada: {{ $carrier['days'] }} Dias</p>
                            @if ($carrier['extra_dimension_price'] > 0 || $carrier['out_of_area_pricing'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Costo Guia: {{ $carrier['basePrice'] }}</p>
                            @endif
                            @if ($carrier['extra_dimension_price'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Cargos Adicionales de la Paqueteria: {{ $carrier['extra_dimension_price'] }}</p>    
                            @endif
                            @if ($carrier['out_of_area_pricing'] > 0)
                                <p class="text-slate-500 text-sm leading-6">Zona Extendida: {{ $carrier['out_of_area_pricing'] }}</p>    
                            @endif
                            <p class="text-slate-800 text-sm leading-6">Costo Total Envio: {{ $carrier['total_pricing'] }}</p>
                        </div>
                    </label>
                </div>
            @endforeach
            
        </form>  --}}

    </div>
</div>
