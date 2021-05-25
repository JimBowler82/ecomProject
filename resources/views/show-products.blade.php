
<x-homepage-layout>

    @unless (Request::is('/'))
        <x-breadcrumbs :ancestors="$ancestors" />
        <hr class="mb-2 border-gray-300">
    @endunless

    <x-slot name="title">{{ $title }}</x-slot>

    <h3 class='text-2xl'>Shop by category</h3>

    <div class="flex p-4 overflow-x-scroll ">

        <x-categories-buttons :categories="$categories" :parentPath="$parent_path ?? '/'"/>

    </div>

    <hr class="border-gray-300">

    <div class="flex items-center justify-between mt-8 mb-2">
        <h3 class='text-2xl '>{{ $title }}</h3>
        <x-search-box :action="route('home')" class="sm:mr-16" :placeholder="'Search products'"/>
    </div>

    @if(count($products))

        <div class='flex flex-wrap justify-center'>

            @foreach ($products as $product )
                <x-product-card :product="$product"/>
            @endforeach

        </div>
        <div class="w-3/4 mx-auto mt-8">

            {{ $products->links() }}

        </div>

    @else
        <h1 class="text-center">No Products - Check back later!</h1>
    @endif

</x-homepage-layout>
