<div>
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">

            <h1 class="font-semibold text-gray-700 uppercase">{{$category->name}}</h1>

            <div class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer {{ $view == 'grid' ? 'text-green-200' : '' }}" wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list p-3 cursor-pointer {{ $view == 'list' ? 'text-green-200' : '' }}" wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <div class="bg-white rounded-lg shadow col-span-1 py-2 px-2">
            <aside>
                
                <h2 class="font-semibold text-center mb-2">Subcategorias</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach ($category->subcategories as $subcategory)
                        <li class="py-2 text-sm">
                            <a class="cursor-pointer hover:text-yellow-500 hover:underline capitalize {{ $subcategoria == $subcategory->name ? 'text-yellow-500 font-semibold' : '' }}" 
                                wire:click="$set('subcategoria', '{{$subcategory->name}}')"    
                            >{{$subcategory->name}}</a>
                        </li>
                    @endforeach
                </ul>
                
                <h2 class="font-semibold text-center mt-4 mb-2">Marcas</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach ($category->brands as $brand)
                        <li class="py-2 text-sm">
                            <a class="cursor-pointer hover:text-yellow-500 hover:underline capitalize {{ $marca == $brand->name ? 'text-yellow-500 font-semibold' : '' }}" 
                                wire:click="$set('marca', '{{$brand->name}}')"  
                            >{{$brand->name}}</a>
                        </li>
                    @endforeach
                </ul>

                <x-button class="text-black bg-green-300 bg-opacity-60 hover:bg-yellow-400 mt-4" wire:click="limpiar">
                    Eliminar Filtros
                </x-button>
            </aside>
        </div>
        <div class="md:col-span-2 lg:col-span-4">
            @if ($view == 'grid')
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <li class="bg-white rounded-lg shadow">
                            <article>
                                <figure>
                                    <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                </figure>

                                <div class="py-4 px-6">
                                    <h1 class="text-lg font-semibold">
                                        <a href="{{ route('products.show', $product) }}">
                                            {{Str::limit($product->name, 12)}}
                                        </a>
                                    </h1>

                                    <p class="font-bold text-gray-700">$ {{$product->price}} USD</p>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
            @else
                <ul>
                    @foreach ($products as $product)
                        
                        <x-product-list :product="$product" />

                    @endforeach
                </ul>
            @endif
                

            <div class="mt-4">
                {{$products->links()}}
            </div>
        </div>

    </div>
</div>
