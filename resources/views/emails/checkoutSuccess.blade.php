@component('mail::message')
Hi! {{ ucwords($order->customer_name) }} <br>

<br>

Thank you for your order, here are the details:
<ul>
@foreach ( $order->line_items as $item )
<li>{{ $item['description'] }}  |  Quantity: {{ $item['quantity'] }}  @  Price: £{{ number_format($item['amount_total'] / 100, 2, '.', '') }}</li>
@endforeach
<br>
<li>Delivery Fee: £{{ number_format(($order->total - $order->sub_total) / 100, 2, '.', '' ) }}</li>
<li><strong>Order Total: £{{ number_format($order->total / 100, 2, '.', '') }}</strong></li>
</ul>

<br>
<br>

Thanks,<br>
{{ config('app.name') }}

@component('mail::button', ['url' => 'http://ecomproject.test'])
See Our Latest Deals !
@endcomponent

<x-slot name="subcopy">
<strong>Order Total:</strong> £{{ number_format($order->total / 100, 2, '.', '') }}
<br>
<strong>Customer Address:</strong><br>
{{ $order->address['line1'] }}<br>
{{ $order->address['city'] }}<br>
{{ $order->address['postal_code'] }}<br>
{{ $order->address['country'] }}
<br>
<strong>Customer email: </strong> {{ $order->customer_email }}
</x-slot>

@endcomponent
