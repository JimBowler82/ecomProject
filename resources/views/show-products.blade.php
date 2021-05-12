
<x-homepage-layout>
    
    <x-slot name="title">{{ $title }}</x-slot>

    <h3 class='text-2xl'>Shop by category</h3>
    <div class="p-4 flex overflow-x-scroll ">
            
        

        @if (isset($categories))

            <x-categories-buttons :categories="$categories" :productType="$productType" :active="$active"/>

        @else

            @if(isset($productTypes))

                <x-productType-buttons :productTypes="$productTypes"/>

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