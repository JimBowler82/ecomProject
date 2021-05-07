<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 h-screen">
        <div class="mx-auto mb-4 w-4/5 lg:w-3/5 flex justify-between items-center" >
            <x-back-btn :path="route('backoffice')"/>
            <a href="/products/create" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-green-300 hover:text-gray-800 transition-colors duration-300">Add New Product</a>
        </div>

        <div class="bg-white mx-auto w-4/5 lg:w-3/5 rounded shadow-xl p-6 overflow-hidden" style="height: 90%">
            <h1 class="text-3xl">Product Manager <small class="text-sm">(showing: {{ count($products) }} products)</small></h1>
            <hr class='mb-3'>

            

            <div class='overflow-scroll p-2' style="height: 100%">

                <table class='border w-full text-center mb-2' style='min-width: 600px'>
                    <thead class="w-full bg-gray-200" style="padding: 5px">
                        <th>Image</th>
                        <th>Manufacturer</th>
                        <th>Model</th>
                        <th>Condition</th>
                        <th>Categories</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
    
                        @foreach ($products as $product)
                            <tr class="border-b-2">
                                <td class='p-2'>
                                    <img src="{{ asset($product->images->first()->location) }}" alt="{{ $product->manufacturer . ' ' . $product->model}}" width='50px' class='mx-auto'>
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
                                    <ul>
                                        @foreach ($product->categories as $category )
                                            <li>{{ $category->name }}</li>
                                        @endforeach
                                    </ul>
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