<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <article>
                    <figure>
                        <img class="rounded-lg shadow-lg" src="{{ Storage::url($product->images->first()->url) }}"
                            alt="">
                        <div class="flex justify-between mt-4">
                            <ul class="flex items-center">
                                @foreach ($product->images as $image)
                                    <li>
                                        <i><img class="h-36 object-cover object-center gap-2"
                                                src="{{ Storage::url($image->url) }}" alt=""></i>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </figure>
                </article>
            </div>

            <div>
                <h1 class="text-4xl text-gray-600">{{ $product->name }}</h1>

                <div class="flex">
                    <p class="text-gray-700">Marca <a class="underline capitalize hover:text-yellow-300"
                            href="">{{ $product->brand->name }}</a></p>
                    <p class="text-gray700 mx-8">5 <i class="fas fa-star text-sm text-yellow-500"></i> </p>
                    <p class="text-yellow-500 hover:text-red-700 underline"> 31 reseñas</p>
                </div>

                <div class="border-b border-gray-300 mb-6">
                    <nav class="flex gap-4">
                        <a href="#" title=""
                            class="border-b-2 border-gray-900 py-4 text-sm font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800">
                            Description </a>
                        <h3 class="text-2xl text-gray-500">{{ $product->descriprion_es }}</h3>
                    </nav>
                </div>

                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span
                            class="flex items-center justify-center h-10 w-10 rounded-full bg-emerald-400 bg-opacity-80">
                            <i class="fas fa-truck text-white"></i>
                        </span>

                        <div class="ml-4">
                            <p class="text-lg text-gray-600">Envios a toda la Republica Mexicana</p>
                            <p class="text-md text-gray-500">Fecha estimada de Entrega:
                                {{ now()->addDay(7)->locale('es_ES')->isoFormat('D [de] MMMM [del] YYYY') }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="border-t border-b py-4 mt-7 border-gray-200">
                        <div data-menu class="flex justify-between items-center cursor-pointer">
                            <p class="text-base leading-4 text-emerald-400 dark:text-emerald-300">Envíos y devoluciones
                            </p>
                            <button
                                class="cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 rounded"
                                role="button" aria-label="show or hide">
                                <img class="transform dark:hidden"
                                    src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4.svg"
                                    alt="dropdown">
                                <img class="transform hidden dark:block"
                                    src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4dark.svg"
                                    alt="dropdown">
                            </button>
                        </div>
                        <div class="hidden pt-4 text-base leading-normal pr-12 mt-4 text-gray-600 dark:text-gray-300"
                            id="sect">
                            <p class="text-md text-gray-500">Usted será responsable de pagar sus propios gastos de envío
                                para devolver su artículo. Los gastos de envío no son reembolsables.</p>
                        </div>
                    </div>
                </div>


                <div class="border-b border-gray-300">
                    <nav class="flex gap-4">
                        <a href="#" title=""
                            class="border-b-2 border-gray-600 py-4 text-sm font-medium text-gray-600 hover:border-gray-400 hover:text-gray-400">
                            Dimenciones del Producto </a>

                    </nav>
                </div>

                <div class="flex flex-col">
                    <div class="mt-6 flow-root justify-between">
                        <div class="flex items-center">
                            <h3 class="text-md text-gray-500 mx-4">Largo: {{ $product->length }} cm.</h3>
                            <h3 class="text-md text-gray-500 mx-4">Ancho: {{ $product->width }} cm.</h3>
                            <h3 class="text-md text-gray-500 mx-4">Alto: {{ $product->height }} cm.</h3>
                        </div>
                        <div class="flex items-center">
                            <h3 class="text-md text-gray-500 mt-2 ml-4">Peso: {{ $product->weight }} kg.</h3>
                        </div>

                    </div>
                </div>

                <div class="flex items-end mt-6">
                    <h1 class="text-3xl text-gray-500 font-bold">${{ $product->price }}</h1>
                    <span class="text-base">USD</span>
                </div>

                <div
                    class="mt-6 flex flex-col items-center justify-between space-y-4 border-t border-b py-4 sm:flex-row sm:space-y-0">
                    

                    {{-- <button type="button" class="inline-flex items-center justify-center rounded-md border-2 border-transparent bg-emerald-300 bg-none px-12 py-3 text-center text-base font-bold text-gray-600 transition-all duration-200 ease-in-out focus:shadow hover:bg-green-200">
                      <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                      </svg>
                      Agregar al Carro
                    </button> --}}

                    @if ($product->subcategory->size)
                        @livewire('add-cart-item-size', ['product' => $product])
                    @elseif($product->subcategory->color)
                        @livewire('add-cart-item-color', ['product' => $product])
                    @else
                        @livewire('add-cart-item', ['product' => $product])
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            let elements = document.querySelectorAll("[data-menu]");
            for (let i = 0; i < elements.length; i++) {
                let main = elements[i];
                main.addEventListener("click", function() {
                    let element = main.parentElement.parentElement;
                    let andicators = main.querySelectorAll("img");
                    let child = element.querySelector("#sect");
                    child.classList.toggle("hidden");
                    andicators[0].classList.toggle("rotate-180");
                });
            }
        </script>
    @endpush
</x-app-layout>
