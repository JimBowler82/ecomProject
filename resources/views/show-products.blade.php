
<x-homepage-layout>
    
    <x-slot name="title">{{ $title }}</x-slot>

    <h3 class='text-2xl'>Shop by category</h3>
    <div class="p-4 flex overflow-x-scroll">
            
        

        @if (isset($categories))

            @foreach ($categories as $category )
                <a href="/{{ $productType->slug }}/{{ $category->slug }}" class='inline-block bg-white px-2 py-1 rounded font-bold hover:bg-green-300 mt-2 mr-3 transition-all duration-300 {{ isset($active) && $active == $category->slug ?  'bg-green-300':''}}' >{{ $category->name }}</a>
            @endforeach
            @if (isset($active))
                <a href="/{{ $productType->slug }}" class='inline-block bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Show All</a>
            @endif

        @else

            @if(isset($productTypes))

                @foreach ($productTypes as $type )
                    <a href="/{{ $type->slug }}" class='ml-3 pt-2 px-3 bg-white hover:bg-gray-300 transition-colors duration-300 shadow-lg flex flex-col w-48 flex-none'>
                        <div class='shadow-md p-1 bg-white flex-1 flex items-center justify-center'>
                            <img src="{{ asset($type->image->location) }}" alt="" class="max-h-32">
                        </div>
                        <p class="mt-3">{{ $type->name }}</p>
                    </a>
                @endforeach

            @endif
            
        @endif
        
        
        
    </div>
    <hr>
    <h3 class='text-2xl mt-8 mb-2'>{{ $title }}</h3>
    @if($products)
        <div class='flex flex-wrap justify-center'>
            @foreach ($products as $product )
                <x-product-card :product="$product"/>
            @endforeach
        </div>
        <div class="w-3/4 mx-auto mt-8">
            {{ $products->links() }}
        </div>
    @else
        <h1>No Products</h1>
    @endif
</x-homepage-layout>