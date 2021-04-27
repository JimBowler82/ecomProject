<x-homepage-layout>
    <h1>Cart Page</h1>
    @if ($cart)
    
        @foreach ($cart['cart-contents'] as $id => $details)
            <div class='bg-white mb-3 p-3 rounded flex'>
                <div class='mr-4'>
                    <img src="{{ $details['picture'] }}" alt="" width='50px'>
                </div>
                <div>
                    <h1>Product ID: {{ $id }}</h1>
                <p>£{{ $details['price'] }}</p>
                <div>Quantity: <a href="/cart/remove/{{ $id }}" class='ml-1'><i class="far fa-minus-square"></i></a><span class='ml-1 mr-1'>{{ $details['quantity'] }}</span><a href="/cart/add/{{ $id }}"><i class="far fa-plus-square"></i></a></div>
                </div>
            </div>
        @endforeach

        <div class='bg-white p-3 rounded'>
            <h3>Number of items in cart: {{ $cart['cart-quantity'] }}</h3>
            <h4>Total: {{ $cart['cart-total'] }}</h4>
        </div>
    @endif
</x-homepage-layout>