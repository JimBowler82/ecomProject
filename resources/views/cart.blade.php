<x-homepage-layout>
    <div class='bg-white p-3 shadow-2xl'>
        <h1 class='text-3xl'>Your Shopping Cart</h1>
    
    
        @if ($cart)
        
            @foreach ($cart['cart-contents'] as $id => $details)
            
                <div class='flex border-b-2 border-gray-200 m-4 p-3'>
                    <div class='mr-4 flex items-center'>
                        <img src="{{ $details['picture'] }}" alt="" width='50px'>
                    </div>

                    <div class='flex items-center flex-1'>
                        <div class=''>
                            <h2 class='font-bold'>{{ $details['manufacturer']}}</h2>
                            <h3>{{ $details['model'] }}</h3>
                        </div>

                        <div class='flex items-center flex-1 flex-col sm:flex-row'>
                            <p class='flex-1 text-center'>£{{ $details['price'] }} each</p>
                            <div class='flex-1 text-center flex flex-col md:flex-row mt-2 mb-2'>
                                <p>Quantity:</p>
                                <div>
                                    <a href="/cart/remove/{{ $id }}" class='ml-1'><i class="far fa-minus-square"></i></a><span class='ml-1 mr-1'>{{ $details['quantity'] }}</span><a href="/cart/add/{{ $id }}"><i class="far fa-plus-square"></i></a></div>
                                </div>
                            <p class='flex-1 text-center'>Sub-total: £{{ $details['quantity'] * $details['price']}}</p>
                        </div>

                        <div class='self-stretch flex items-center px-4 text-2xl text-red-400'>
                            <a href="/cart/remove/{{ $id }}/all"><i class="fas fa-trash-alt"></i></a>
                        </div>
                        
                    </div>
                </div>
            @endforeach

            <div class='bg-white p-3 mt-10 w-9/12 sm:w-4/5 mx-auto rounded flex flex-col sm:flex-row'>
                <div class='flex-1'>
                    <h3>Number of items in cart: {{ $cart['cart-quantity'] }}</h3>
                    <h4 class='text-4xl mt-3'>Total: £{{ $cart['cart-total'] > 0 ? $cart['cart-total'] : '0.00' }}</h4>
                </div>
                <div class='flex flex-col text-white mt-6 sm:mt-0'>
                    <button class='bg-gray-800 px-3 py-2 rounded mb-2 hover:bg-green-300 hover:text-gray-800 transition-colors duration-300 shadow'>Checkout</button>
                    <a href="{{ url('/') }}" class='bg-gray-800 px-3 py-2 rounded hover:bg-blue-300 hover:text-gray-800 transition-colors duration-300 text-center'>Continue Shopping</a>
                </div>
            </div>
        @endif
    </div>
</x-homepage-layout>