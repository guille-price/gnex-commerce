<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">

        {{-- Inicio Direccion y contacto --}}
        {{-- <div class="bg-white rounded-lg shadow p-4">

            <div class="mb-4">
                <x-label value="Nombre de contácto" />
                <x-input type="text" wire:model.defer="contact"
                    placeholder="Ingrese el nombre de la persona que recibirá el producto" class="w-full" />
                <x-input-error for="contact" />
            </div>

            <div>
                <x-label value="Teléfono de contacto" />
                <x-input type="text" wire:model.defer="phone" placeholder="Ingrese un número de telefono de contácto"
                    class="w-full" />

                <x-input-error for="phone" />
            </div>

            <div x-data="{ envio_type: @entangle('envio_type') }">
                <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>

                <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                    <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Recojo en tienda (Calle Falsa 123)
                    </span>

                    <span class="font-semibold text-gray-700 ml-auto">
                        Gratis
                    </span>
                </label>

                <div class="bg-white rounded-lg shadow">
                    <label class="px-6 py-4 flex items-center cursor-pointer">
                        <input x-model="envio_type" type="radio" value="2" name="envio_type"
                            class="text-gray-600">
                        <span class="ml-2 text-gray-700">
                            Envío a domicilio
                        </span>

                    </label>

                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">

                        
                        <div>
                            <x-label value="Estado" />

                            <select
                                class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 rounded-md shadow-sm w-full"
                                wire:model="state_id">
                                <option value="" disabled selected>Seleccione un Estado</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>

                            <x-input-error for="state_id" />
                        </div>

                        
                        <div>
                            <x-label value="Ciudad" />
                            <x-input class="w-full" wire:model="city" type="text" />
                            <x-input-error for="city" />
                        </div>

                        <div>
                            <x-label value="Dirección/Calle" />
                            <x-input class="w-full" wire:model="address_1" type="text" />
                            <x-input-error for="address_1" />
                        </div>

                        <div>
                            <x-label value="Dirección/Numero" />
                            <x-input class="w-full" wire:model="number_address" type="text" />
                            <x-input-error for="number_address" />
                        </div>


                        <div>
                            <x-label value="Colonia" />
                            <x-input class="w-full" wire:model="address_2" type="text" />
                            <x-input-error for="address_2" />
                        </div>

                        <div class="col-span-1">
                            <x-label value="Codigo Postal" />
                            <x-input class="w-full" wire:model.live="postcode" type="text" />
                            <x-input-error for="postcode" />
                            <x-button class="" type="button" wire:click.stop="chooseShipping">
                                Ver Envios
                            </x-button> {{ $postcode }}
                        </div>


                        <div class="col-span-2">
                            <x-label value="Referencia" />
                            <x-input class="w-full" wire:model="reference" type="text" />
                            <x-input-error for="reference" />
                        </div>

                        <div class="col-span-2">
                            
                        </div>

                    </div>
                </div>

            </div>

            <div>
                <x-button-cart wire:loading.attr="disabled" wire:target="create_order" class="mt-6 mb-4"
                    wire:click="create_order">
                    Continuar con la compra
                </x-button-cart>

                <hr>

                <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam
                    atque quo, labore facere placeat illo consequatur hic ut sapiente exercitationem, architecto iure,
                    consequuntur impedit ex iusto ipsa voluptas laudantium iste <a href=""
                        class="font-semibold text-orange-500">Políticas y privacidad</a></p>
            </div>

        </div> --}}
        {{-- Fin Direccion y contacto --}}
        {{-- <p class="mb-2">Direcciones: {{ $addressesCount }}</p> --}}

        <div>
            <livewire:add-address-order />
        </div>

        @if ($confirmed_address)
            <div class="mt-4">
                <livewire:shipping lazy="on-load" :address="$address" />
            </div>
        @endif
    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-4">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 rounded-lg shadow-lg object-cover mr-4" src="{{ $item->options->image }}"
                            alt="">

                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>

                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options['weight'])
                                    <p class="mx-2">- Peso: {{ __($item->options['weight']) }}</p>
                                @endisset
                                @isset($item->options['color'])
                                    <p class="mx-2">- Color: {{ __($item->options['color']) }}</p>
                                @endisset

                                @isset($item->options['size'])
                                    <p>{{ $item->options['size'] }}</p>
                                @endisset

                            </div>

                            <p>USD {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningún item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{ Cart::subtotal() }} USD</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío @if ($shipping_cost > 0)
                        - {{ $service }} <img class="w-12 object-contain"
                            src="{{ url('storage/img/carriers/' . $provider . '.svg') }}" alt="" />
                    @endif
                    <span class="font-semibold">
                        @if ($envio_type === 1)
                            Gratis
                        @else
                            {{-- <p>{{$service}}</p> --}}
                            {{ $shipping_cost }} USD
                            
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                {{-- @if ($envio_type === 2)
                    <p class="flex justify-between items-center font-semibold">
                        <span class="text-lg">Envio</span>

                        {{ $shipping_cost }} USD
                    </p>
                @endif --}}

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($envio_type === 1)
                        {{ Cart::subtotal() }} USD
                    @else
                        {{ Cart::subtotal() + $shipping_cost }} USD
                    @endif
                </p>

                <hr class="mt-4 mb-3">

                <div class="flex justify-center mt-2 mb-2">

                    <x-button-cart class="w-full" wire:loading.attr="disabled" wire:target="create_order"
                        class="mt-6 mb-4" wire:click="create_order">
                        Continuar con la compra
                    </x-button-cart>
                </div>
            </div>


        </div>
    </div>
</div>
