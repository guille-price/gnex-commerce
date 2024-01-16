<div x-data>

    @if (session('email_guest') && $addresses->count() >= 1)

        <div class="bg-white rounded-lg shadow p-4">

            {{-- <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                <a href="#" class="mt-4 rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"> 
                <a wire:click="add_new_address()" href="#" class="mt-4 rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"> 
                    Edit
                </a>
            </td> --}}

            <div class="relative mb-2">
                <div class="bottom-0 right-0">

                    <button wire:click="add_new_address({{ session('email_guest') }})" wire:loading.attr="disabled"
                        wire:target="add_new_address"
                        class="mt-4 px-2 py-2 bg-yeonhi-st rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yeonhi-lt">
                        <div>Agregar Nueva Direccion</div>

                        {{-- <div wire:loading
                            class="w-8 h-8 animate-spin rounded-full bg-gradient-to-r from-yeonhi via-yeonhi-st to-yeonhi-gl ">
                            <div
                                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-gray-200 rounded-full border-2 border-white">
                                <img src="{{ Storage::url('img/logo.png') }}">
                            </div>
                        </div> --}}
                    </button>



                    {{-- <div wire:loading >
                        <div wire:loading>

                            <div wire:loading
                                class="w-8 h-8 animate-spin rounded-full bg-gradient-to-r from-yeonhi via-yeonhi-st to-yeonhi-gl ">
                                <div
                                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-gray-200 rounded-full border-2 border-white">
                                    <img src="{{ Storage::url('img/logo.png') }}"></div>
                            </div>
                        </div>
                    </div> --}}


                </div>

                {{-- <div wire:loading class="flex items-center space-x-2">
                    <div wire:loading aria-label="Loading..." role="status">
                        <div wire:loading
                                class="flex justify-start w-8 h-8 animate-spin rounded-full bg-gradient-to-r from-yeonhi via-yeonhi-st to-yeonhi-gl ">
                                <div
                                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-gray-200 rounded-full border-2 border-white">
                                    <img src="{{ Storage::url('img/logo.png') }}"></div>
                            </div>
                    </div>
                    <span class="text-xs font-medium text-slate-500">Cargando...</span>
                </div> --}}
            </div>

            <div class="flex items-center justify-center">

                <!-- Component Start -->
                {{-- <form class="grid grid-cols-3 gap-2 w-full"> --}}

                <div class="flex px-2 py-2 grid grid-cols-2 gap-2 w-full">

                    @foreach ($addresses as $address)
                        <div class="rounded-md shadow">
                            <input class="peer hidden" id="radio_{{ $loop->iteration }}" value="{{ $address->id }}"
                                type="radio" wire:model="address_id" name="address_saved">
                            <label
                                class="peer-checked:border-2 peer-checked:border-green-700 peer-checked:bg-green-100 cursor-pointer select-none rounded-lg flex flex-col p-2 border-2 border-gray-400 cursor-pointer"
                                for="radio_{{ $loop->iteration }}">
                                <span class="text-xs font-semibold uppercase">{{ $address->contact }}</span>
                                <p class="text-xl font-bold mt-2">{{ $address->email }}</p>
                                <ul class="text-sm mt-2">
                                    <li>{{ $address->address_1 }} {{ $address->number_address }}
                                        {{ $address->address_2 }}, {{ $address->city }}</li>
                                    <li>C.P.{{ $address->postcode }}</li>
                                </ul>
                            </label>
                        </div>
                    @endforeach

                    <div
                        class="flex justify-center items-center max-w-[414px] p-[20px] border border-[#e5e5e5] rounded-[12px] max-sm:flex-wrap">
                        <div class="flex gap-x-[10px] items-center cursor-pointer" wire:click="add_new_address"
                            role="button" tabindex="0"><span
                                class="icon-plus p-[10px] border border-black rounded-full text-[30px]"
                                role="presentation"></span>
                            <p class="text-[16px]">Agregar Direccion</p>
                        </div>
                    </div>


                </div>

                {{-- </form> --}}

            </div>

            <!-- Span right edge -->
            <div class="relative">
                <div style="display: flex; justify-content: flex-end">

                    <button wire:click="confirm_address({{ $address->id }})"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50"
                        class="mt-4 px-2 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Confirmar Direccion
                    </button>

                </div>
            </div>

        </div>
    @else
        <div class="bg-white rounded-lg shadow p-4" wire:loading.class="opacity-50">

            {{-- Inicia Codigo si No tiene una direccion el email guest --}}
            <form method="POST" wire:submit="create_address">
                <div class="mb-4 w-full">
                    <x-label value="Nombre de contácto" />
                    <x-input type="text" wire:model.defer="contact"
                        placeholder="Ingrese el nombre de la persona que recibirá el producto" class="w-full" />
                    <x-input-error for="contact" />
                </div>

                <div class="mb-4 w-full">
                    <x-label value="Correo Electronico" />
                    <x-input type="text" wire:model.defer="email" placeholder="Ingrese el correo electronico"
                        class="w-full" />
                    <x-input-error for="email" />
                </div>

                <div>
                    <x-label value="Teléfono de contacto" />
                    <x-input type="text" wire:model="phone" placeholder="Ingrese un número de telefono de contácto"
                        class="w-full" />

                    <x-input-error for="phone" />
                </div>


                {{-- <div class="bg-white rounded-lg shadow"> --}}

                {{-- <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }"> --}}
                <div class="px-6 pb-6 grid grid-cols-2 gap-6 mt-6">
                    {{-- Estados --}}
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

                    {{-- Estados --}}
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
                        <x-input class="w-full" wire:model.defer="postcode" />
                        <x-input-error for="postcode" />
                        {{-- <x-button class="" type="button" wire:click.stop="chooseShipping">
                        Ver Envios
                    </x-button> {{ $postcode }} --}}
                    </div>


                    <div class="col-span-2">
                        <x-label value="Referencia" />
                        <x-input class="w-full" wire:model="reference" type="text" />
                        <x-input-error for="reference" />
                    </div>

                    <div class="col-span-2 text-red-600" wire:loading>Agregando Direccion...</div>

                    <div class="col-span-2">
                        <button type="submit" wire:loading.attr="disabled"
                            class="mt-2 px-2 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                            wire:loading.class="opacity-50">
                            Agregar Direccion
                        </button>
                    </div>



                </div>
                {{-- </div> --}}
            </form>
            {{-- Fin Codigo si No tiene una direccion el email guest --}}


        </div>


    @endif


    {{-- Inicio Modal Pantalla --}}

    <div @class([
        'fixed top-12 bottom-0 left-0 flex h-full w-full items-center justify-center bg-gray-800 bg-opacity-60',
        'hidden' => !$showModal,
    ])>
        <div class="w-1/2 rounded-lg bg-white">
            <form wire:submit="create_address" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="flex w-full items-center border-b pb-4">
                        <div class="text-lg font-medium text-gray-900">Nueva Direccion {{ session('email_guest') }}
                        </div>
                        <svg wire:click="$toggle('showModal')"
                            class="ml-auto h-6 w-6 cursor-pointer fill-current text-gray-700"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>

                    {{-- Campos --}}
                    <div class="mb-4 w-full">
                        <x-label value="Nombre de contácto" />
                        <x-input type="text" wire:model.defer="contact"
                            placeholder="Ingrese el nombre de la persona que recibirá el producto" class="w-full" />
                        <x-input-error for="contact" />
                    </div>

                    <div class="mb-4 w-full">
                        <x-label value="Correo Electronico" />
                        <x-input type="email" wire:model="email" id="email" value="{{ $email }}"
                            placeholder="Ingrese el correo electronico" class="w-full" />
                        <x-input-error for="email" />
                    </div>

                    <div class="w-full">
                        <x-label value="Teléfono de contacto" />
                        <x-input type="text" wire:model="phone"
                            placeholder="Ingrese un número de telefono de contácto" class="w-full" />

                        <x-input-error for="phone" />
                    </div>


                    {{-- <div class="bg-white rounded-lg shadow"> --}}

                    {{-- <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }"> --}}
                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 mt-6">
                        {{-- Estados --}}
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

                        {{-- Estados --}}
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
                            <x-input class="w-full" wire:model.defer="postcode" />
                            <x-input-error for="postcode" />
                            {{-- <x-button class="" type="button" wire:click.stop="chooseShipping">
                            Ver Envios
                        </x-button> {{ $postcode }} --}}
                        </div>


                        <div class="col-span-2">
                            <x-label value="Referencia" />
                            <x-input class="w-full" wire:model="reference" type="text" />
                            <x-input-error for="reference" />
                        </div>

                    </div>
                    {{-- Campos --}}
                    <div class="ml-auto">
                        <button wire:loading.attr="disabled"
                            class="mt-2 rounded-md bg-yeonhi px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-yeonhi-st"
                            type="submit">
                            <div wire:loading.remove>Guardar</div>

                            <div wire:loading>Agregando...</div>
                            <div wire:loading
                                class="w-8 h-8 animate-spin rounded-full bg-gradient-to-r from-yeonhi via-yeonhi-st to-yeonhi-gl ">
                                <div
                                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-gray-200 rounded-full border-2 border-white">
                                    <img src="{{ Storage::url('img/logo.png') }}">
                                </div>
                            </div>
                        </button>



                        <button wire:click="$toggle('showModal')"
                            class="mt-2 rounded-md bg-yeonhi-gl px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-yeonhi-bk"
                            type="button">
                            Cerrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Fin Modal Pantalla --}}

</div>
