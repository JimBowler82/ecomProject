<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="h-screen pt-20">
        <div class="flex items-center justify-between w-4/5 mx-auto mb-4" >
            <x-back-btn :path="route('backoffice')"/>

        </div>

        <div class="w-4/5 p-6 mx-auto overflow-hidden bg-white rounded shadow-xl" style="height: 90%">
            <div class="flex flex-col items-center justify-between mb-3 sm:flex-row">
                <h1 class="flex flex-wrap text-3xl">Order Manager <small class="self-end pb-1 pl-2 text-sm">(showing: {{ $orders->count() }} orders)</small></h1>
                <x-search-box :action="url('/orders')" class="w-full mr-2 sm:w-auto" :placeholder="'Search orders'" />
            </div>

            <hr class='mb-3'>



            <div class='p-2 overflow-scroll' style="height: 100%">

                <table class='w-full mb-12 text-center border' style='min-width: 600px'>
                    <thead class="w-full bg-gray-200" style="padding: 5px">
                        <th>ID</th>
                        <th>Stripe Session ID</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr class="border-b-2">
                                <td class='p-2'>
                                    {{ $order->id }}
                                </td>
                                <td class='p-0'>
                                    {{ $order->session_id }}
                                </td>
                                <td class="font-bold {{ $order->status === 'paid' ? 'p-2 text-green-500' : 'p-2 text-red-500'}}">
                                    {{ strtoupper($order->status) }}
                                </td>
                                <td class='p-2'>
                                    £{{ number_format($order->total / 100, 2, '.', '') }}
                                </td>
                                <td class='p-2'>
                                    {{ $order->created_at }}
                                </td>
                                <td class='p-2'>
                                    <x-action-buttons type="orders" :identifier="$order->id"/>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>

    </div>



</x-app-layout>
