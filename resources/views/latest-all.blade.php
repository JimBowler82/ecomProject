<x-homepage-layout>
    <h3 class='text-2xl'>Categories</h3>
    <div class="p-4">
        @foreach ($categories as $category )
            <a href="/{{ $category->slug }}" class='bg-white px-2 py-1 rounded hover:underline font-bold hover:bg-green-300 mr-3'>{{ $category->name }}</a>
        @endforeach
        
    </div>
    <hr>
    <h3 class='text-2xl mt-8 mb-2'>Latest Products</h3>
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