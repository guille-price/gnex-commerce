<div x-data>
    <div>
        <p class="text-xl text-amber-400">Talla:</p>

        <select wire:model.live='size_id' 
                class="w-full border-gray-300 focus:border-emerald-200 focus:ring-emerald-300 rounded-md shadow-sm">
            <option value="" selected disabled>Seleccione una Talla</option>

            @foreach ($sizes as $size)
                <option value="{{$size->id}}">{{$size->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4">
        <p class="text-xl text-amber-400">Color:</p>

        <select wire:model.live='color_id'
                class="w-full border-gray-300 focus:border-emerald-200 focus:ring-emerald-300 rounded-md shadow-sm">
            <option class="capitalize" value="" selected disabled>Seleccione un Color</option>

            @foreach ($colors as $color)
                <option value="{{$color->id}}">{{$color->name}}</option>
            @endforeach
        </select>
    </div>

    <p class="text-gray-600 mt-4 mb-4">
        <span class="font-semibold text-lg">Stock disponible: </span> 
        @if ($stockQty)
            {{$stockQty}}
        @else
            {{$product->stock}}    
        @endif        
    </p>

    <div class="flex mt-4">
        <div class="mr-6">
            <x-button-cart disabled x-bind:disabled="$wire.qty <= 1" wire:loading.attr="disabled" wire:target="decrement"
                wire:click="decrement">
                -
            </x-button-cart>

            <span class="mx-2 text-gray-700">{{ $qty }}</span>

            <x-button-cart x-bind:disabled="$wire.qty >= $wire.stockQty" wire:loading.attr="disabled"
                wire:target="increment" wire:click="increment">
                +
            </x-button-cart>
        </div>

        <div>
            <x-button-cart x-bind:disabled="!$wire.stockQty"
                class="inline-flex items-center justify-center rounded-md border-2 border-transparent bg-emerald-300 bg-none px-12 py-2 text-center text-base font-bold text-gray-600 transition-all duration-200 ease-in-out focus:shadow hover:bg-green-200"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
                <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Agregar al Carro
            </x-button-cart>
        </div>
    </div>
</div>
