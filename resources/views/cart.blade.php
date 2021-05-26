<x-homepage-layout>

    <x-slot name='title'>Cart</x-slot>

    <div class='p-3 bg-white shadow-2xl'>
        <h1 class='mt-3 ml-6 text-3xl'>Your Shopping Cart</h1>



        @if (!$cart || $cart['cart-quantity'] === 0)
            <p class='w-1/2 pl-20 m-16'>You have no items</p>
            <div>
                <a href="{{ url('/') }}" class='px-3 py-2 ml-6 text-center text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-blue-300 hover:text-gray-800'>Continue Shopping</a>
            </div>
        @else
            @foreach ($cart['contents'] as $id => $details)

                <div class='flex p-3 m-4 border-b-2 border-gray-200 item' id="item-{{ $id }}">
                    <div class='flex items-center mr-4'>
                        <img src="{{ Storage::url($details['product']->images->first()->location) }}" alt="" width='50px'>
                    </div>

                    <div class='flex items-center flex-1'>
                        <div class='w-1/4'>
                            <h2 class='font-bold'>{{ $details['product']->manufacturer}}</h2>
                            <h3>{{ $details['product']->model }}</h3>
                        </div>

                        <div class='flex flex-col items-center flex-1 sm:flex-row'>
                            <p class='flex-1 text-center' id="item-price">£{{ number_format($details['product']->price / 100, 2, '.', '') }} each</p>
                            <div class='flex flex-col justify-center flex-1 mt-2 mb-2 text-center md:flex-row'>
                                <p>Quantity:</p>
                                <div>
                                    <a href="/cart/remove/{{ $id }}" class='ml-1' >  <!-- /cart/remove/{{ $id }} -->
                                        <i class="far fa-minus-square"></i>
                                    </a>
                                    <span class='ml-1 mr-1' id="quantity">
                                        {{ $details['quantity'] }}
                                    </span>
                                    <a href="/cart/add/{{ $id }}"> <!-- /cart/add/{{ $id }} -->
                                        <i class="far fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                            <p class='flex-1 text-center' id="item-total">Sub-total: £{{ number_format(($details['quantity'] * $details['product']['price']) / 100, 2, '.', '')  }}</p>
                        </div>

                        <div class='flex items-center self-stretch px-4 text-2xl text-red-400'>
                            <a href="/cart/remove/{{ $id }}/all"><i class="fas fa-trash-alt"></i></a>
                        </div>

                    </div>
                </div>
            @endforeach

            <div class='flex flex-col w-9/12 p-3 mx-auto mt-10 bg-white rounded sm:w-4/5 sm:flex-row'>
                <div class='flex-1'>
                    <h3>Number of items in cart: {{ $cart['cart-quantity'] }}</h3>
                    <h4 class='mt-3 text-4xl'>Total: £{{ $cart['cart-total'] > 0 ? number_format($cart['cart-total'] / 100, 2, '.', '')  : '0.00' }}</h4>
                </div>
                <div class='flex flex-col mt-6 text-white sm:mt-0'>

                    <button type="button" id="checkout-button" class='px-3 py-2 mb-2 transition-colors duration-300 bg-gray-800 rounded shadow hover:bg-green-300 hover:text-gray-800' >Checkout</button>
                    <a href="{{ url('/') }}" class='px-3 py-2 text-center transition-colors duration-300 bg-gray-800 rounded hover:bg-blue-300 hover:text-gray-800'>Continue Shopping</a>
                </div>
            </div>

        @endif


    </div>

    @section('page-script')
        <script type="text/javascript">

        // Create an instance of the Stripe object with your publishable API key
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const checkoutButton = document.getElementById('checkout-button');
        const token = "{{ csrf_token() }}";

        checkoutButton.addEventListener('click', function() {
            console.log('clicked');
            // Create a new Checkout Session using the server-side endpoint you
            // created in step 3.
            fetch('/create-checkout-session', {
            method: 'POST',
            headers: {
                "X-CSRF-Token": token,
            }
            })
            .then(function(response) {
            return response.json();
            })
            .then(function(session) {
            return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function(result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, you should display the localized error message to your
            // customer using `error.message`.
            if (result.error) {
                alert(result.error.message);
            }
            })
            .catch(function(error) {
            console.error('Error:', error);
            });
        });

        </script>
    @endsection

</x-homepage-layout>
