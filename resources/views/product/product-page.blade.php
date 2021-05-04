<x-homepage-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class='w-full pl-4 pr-4'>

        <div class='mx-auto mb-6' style='max-width: 900px;'>
            <x-back-btn :path="url('/')"/>
        </div>

        <div class='bg-white mx-auto flex flex-col sm:flex-row p-4 rounded' style='max-width: 900px; '>

            <div class='w-4/5 sm:w-1/2 flex justify-center mx-auto'>
                <img src="{{ asset($product->picture) }}" alt="{{ $product->manufacturer . ' ' . $product->model }}">
            </div>

            <div class='bg-green-100 flex flex-col p-8 sm:w-1/2 ml-2 mt-2 w-full shadow-lg'>
                <ul class='flex-1 flex flex-col justify-center'>
                    <li class='text-3xl text-bold mt-2 mb-2'>
                        {{ $product->manufacturer }} 
                        <span class='text-xl'>{{ $product->model }}</span>
                    </li>
                    <li>
                        <span class='font-bold text-sm'>Condition:</span> {{ $product->condition }}
                    </li>
                    <li class='mt-2 mb-2'>
                        <span class='block text-sm font-bold'>Description:</span>
                        {{ $product->description }}
                    </li>
                    <li class='mt-2 mb-2 font-bold text-xl'>
                        <h2>Price:<span class='ml-3'>£{{ number_format($product->price / 100, 2, '.', '')  }}</span></h2>
                        
                    </li>
                </ul>
                <a href="/cart/add/{{ $product->id }}" class='box-border bg-gray-800 text-white text-center w-11/12 mx-auto py-3 mt-3 justify-self-end border-4 border-gray-800 hover:bg-red-300  hover:border-gray-800 hover:text-gray-800 hover:font-extrabold transition-all duration-300'>Add to basket</a>
            </div>

        </div>
        
    </div>

    
</x-homepage-layout>