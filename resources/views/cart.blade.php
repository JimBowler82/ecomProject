<x-homepage-layout>
    <h1>Cart Page</h1>
    @if ($cart)
    
        @foreach ($cart as $id => $details)
            <div class='bg-white mb-3 p-3 rounded flex'>
                <div class='mr-4'>
                    <img src="{{ $details['picture'] }}" alt="" width='50px'>
                </div>
                <div>
                    <h1>Product ID: {{ $id }}</h1>
                <p>£{{ $details['price'] }}</p>
                <p>Quantity: {{ $details['quantity'] }}</p>
                </div>
            </div>
        @endforeach

        {{-- <div class='bg-white p-3 rounded'>
            <h3>Total quantity of items in cart: {{ $cart['cart-quantity'] }}</h3>
            <h4>Total: {{ $cart['total'] }}</h4>
        </div> --}}
    @endif
</x-homepage-layout>