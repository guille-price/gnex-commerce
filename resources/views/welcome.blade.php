<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        
        {{-- @livewire('slider-gnex') --}}

    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- @foreach ($categories as $category) --}}
                    
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{$categories->last()->name}}
                    </h1>

                    <a href="{{route('categories.show', $categories->last())}}" class="text-amber-500 hover:text-amber-700 hover:underline ml-2 font-semibold">Ver mas</a>
                </div>

                @livewire('category-products', ['category' => $categories->last()])
            </section>

        {{-- @endforeach --}}
    </div>

    @push('js')

        <script>

            // Livewire.on('glider', ({ id }) => {
            //     new Glider(document.querySelector('.glider-' + id), {
            //         slidesToShow: 5.5,
            //         slidesToScroll: 5,
            //         draggable: true,
            //         dots: '.dots',
            //         arrows: {
            //             prev: '.glider-prev',
            //             next: '.glider-next'
            //         }
            //     });
            // });

            // Livewire.on('glider', function(id){            

                new Glider(document.querySelector('.glider'), {
                    slidesToShow: 5.5,
                    slidesToScroll: 5,
                    draggable: true,
                    dots: '.dots',
                    arrows: {
                        prev: '.glider-prev',
                        next: '.glider-next'
                    }
                });
            // });
        </script>

    @endpush
    
</x-app-layout>
