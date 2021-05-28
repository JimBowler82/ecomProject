<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="h-screen pt-20">
        <div class="flex items-center justify-between w-4/5 mx-auto mb-4" >
            <x-back-btn :path="route('backoffice')"/>
            <a href="/products/create" class="px-4 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800">Add New Product</a>
        </div>

        <div class="w-4/5 p-6 mx-auto overflow-hidden bg-white rounded shadow-xl" style="height: 90%">
            <div class="flex flex-col items-center justify-between mb-3 sm:flex-row">
                <h1 class="flex flex-wrap text-3xl">Product Manager <small class="self-end pb-1 pl-2 text-sm">(showing: {{ count($products) }} products)</small></h1>
                <x-search-box :action="url('/products')" class="w-full mr-2 sm:w-auto" :placeholder="'Search products'" />
            </div>

            <hr class='mb-3'>



            <div class='p-2 overflow-scroll' style="height: 100%">

                <table class='w-full mb-12 text-center border' style='min-width: 600px'>
                    <thead class="w-full bg-gray-200" style="padding: 5px">
                        <th>Image</th>
                        <th>Type</th>
                        <th>Manufacturer</th>
                        <th>Model</th>
                        <th>Condition</th>
                        <th>Primary Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                        @foreach ($products as $product)
                            <tr class="border-b-2">
                                <td class='p-2'>
                                    <img src="{{ Storage::url($product->images->first()->location) }}" alt="{{ $product->manufacturer . ' ' . $product->model}}" width='50px' class='mx-auto'>
                                </td>
                                <td class='px-1'>
                                    {{ $product->productType->name }}
                                </td>
                                <td class='p-2'>
                                    {{ $product->manufacturer }}
                                </td>
                                <td class='p-2'>
                                    {{ $product->model }}
                                </td>
                                <td class='p-2'>
                                    {{ $product->condition }}
                                </td>
                                <td class='p-2'>
                                    {{ $product->categories->first()->name }}
                                </td>
                                <td class='p-2'>
                                    £{{ number_format($product->price / 100, 2, '.', '')  }}
                                </td>
                                <td class='p-2'>
                                    <x-action-buttons type="products" :identifier="$product->id"/>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>

    </div>



</x-app-layout>
