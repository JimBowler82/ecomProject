
<x-homepage-layout>
    
    <x-slot name="title">{{ $title }}</x-slot>

    <h3 class='text-2xl'>Categories</h3>
    <div class="p-4">
        @foreach ($categories as $category )
            <a href="/categories/{{ $category->slug }}" class='inline-block bg-white px-2 py-1 rounded font-bold hover:bg-green-300 mt-2 mr-3 transition-all duration-300'>{{ $category->name }}</a>
        @endforeach
        
        

        @if (request()->path() != "/")
            <a href="/" class='inline-block bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Show All</a>
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