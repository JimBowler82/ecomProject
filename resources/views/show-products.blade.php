
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
        <form action="{{ route('home') }}" method="GET">
            <div class="flex items-center">
                <span class="flex items-center self-stretch p-2 bg-white rounded-tl-md rounded-bl-md"><i class="fas fa-search"></i></span>
                <x-input type="search" name="search" class="border-none rounded-tl-none rounded-bl-none sm:mr-16" value="{{ request('search') }}" placeholder="Search products"/>
            </div>
        </form>
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
