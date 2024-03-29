<div>
    @if (count($category->products))

        <div class="glider-contain">
            <ul class="glider">

                @foreach ($category->products as $product)
                    
                    <li class="bg-white rounded-lg shadow {{ $loop->last ? '' : 'mr-4' }}">
                        <article>
                            <figure>
                                <img class="h-48 w-56 object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                            </figure>

                            <div class="py-4 px-6">
                                <h1 class="text-lg font-semibold">
                                    <a href="{{ route('products.show', $product) }}">
                                        {{Str::limit($product->name, 12)}}
                                    </a>
                                </h1>

                                <p class="font-bold text-gray-600">US$ {{$product->price}}</p>
                            </div>
                        </article>
                    </li>

                @endforeach

            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>

    @else
        
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-green-300"></div>
        </div>	

    @endif
    
</div>
