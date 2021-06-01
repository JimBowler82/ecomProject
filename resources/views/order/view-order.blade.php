<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 pb-3 pl-6 pr-6 bg-gray-500" >

        <div class="mx-auto mb-4" style="max-width: 800px">
            <x-back-btn :path="route('orders.index')"/>
        </div>

        <div class='p-6 mx-auto bg-white rounded shadow-xl' style="max-width: 800px">
            <div class="flex items-center justify-between mb-2">
                <h1 class='mb-2 text-2xl'>View Order Page</h1>
                <form action="{{ url("orders/$order->id") }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="button" id="delete" class="px-2 py-2 font-bold text-white transition-colors duration-300 bg-red-600 border-2 border-red-600 rounded-md hover:bg-red-400">Delete Order</button>
                </form>
            </div>
            <hr class="mb-4">

            <div class="flex flex-col p-2 border border-gray-200 rounded">
                <span><strong>ID:</strong> {{ $order->id }}</span>
                <span><strong>Stripe Session:</strong> {{ $order->session_id }}</span>
            </div>

            <div class="p-2 mt-2 border border-gray-200 rounded">
                <h3 class="font-bold underline">Customer</h3>
                <ul>
                    <li><strong>Name: </strong>{{ ucwords($order->customer_name) }}</li>
                    <li><strong>Email: </strong>{{ $order->customer_email }}</li>
                    <li><strong>Telephone: </strong>{{ $paymentObject->charges->data[0]['billing_details']['phone'] ?? 'None'}}</li>
                </ul>
            </div>
            <div class="p-2 mt-2 border border-gray-200 rounded">
                <h3 class="font-bold underline">Items</h3>
                <ul class="ml-8 list-decimal">
                    @foreach ( $order->line_items as $item)
                        <li class="border-b-2"><span class="pl-6">{{ $item['description'] }}</span><span class="pl-8">Qty: {{ $item['quantity'] }}</span><span class="pl-8">@  £{{ number_format($item['amount_total'] / 100, '2', '.', '') }}</span></li>
                    @endforeach
                </ul>
                <div class="mt-6">
                    <p><strong>Sub-total:</strong> £{{ number_format($order['sub_total'] / 100, '2', '.', '') }}</p>
                    <p><strong>Shipping:</strong> £{{ number_format(($order['total'] - $order['sub_total']) / 100, '2', '.', '') }}</p>
                    <p><strong>Total:</strong> £{{ number_format($order['total'] / 100, '2', '.', '') }}</p>
                </div>
            </div>
            <div class="p-2 mt-2 border border-gray-200 rounded">
                <h3 class="font-bold underline">Payment</h3>
                <ul>
                    <li><strong>Currency: </strong>{{ $paymentObject->currency }}</li>
                    <li><strong>Type: </strong> {{ $paymentObject->charges->data[0]['payment_method_details']->type }}</li>
                    <li><strong>Brand: </strong> {{ $paymentObject->charges->data[0]['payment_method_details']->card->brand }}</li>
                    <li><strong>Last 4: </strong> {{ $paymentObject->charges->data[0]['payment_method_details']->card->last4 }}</li>
                    <li><strong>Status: </strong> {{ $paymentObject->charges->data[0]->status }}</li>
                    <li><strong>Amount Received: </strong>  £{{ number_format($paymentObject->amount_received / 100, '2', '.', '')  }}</li>
                </ul>
            </div>

            <div class="p-2 mt-2 border border-gray-200 rounded">
                <h3 class="mb-3 font-bold underline">Customer Receipt</h3>
                <a href="{{ $paymentObject->charges->data[0]->receipt_url }}" target="_blank" class="px-2 py-1 ml-4 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800">View Receipt</a>

            </div>



        </div>

    </div>
    @section('page-script')
        <script>
            const button = document.getElementById('delete');

            button.addEventListener('click', () => {
                if(confirm('Are you sure you want to delete this order?')) {
                    button.parentElement.submit();
                }
            });

        </script>
    @endsection

</x-app-layout>
