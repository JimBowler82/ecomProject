
 
<?php
    $cart = session('cart');
?>




<a href="{{ url('/cart') }}" class='text-lg mr-4 p-2 rounded-lg flex items-center   hover:bg-green-300 hover:text-gray-800 transition-colors duration-300 cursor-pointer'>
    <i class="fa fa-shopping-cart w-4 mr-4" aria-hidden="true"></i> ({{ $cart ? count($cart) : 0 }}): £0.00
</a>