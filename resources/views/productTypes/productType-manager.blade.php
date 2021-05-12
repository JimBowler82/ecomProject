<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 h-screen">
        <div class="mx-auto mb-4 w-4/5  flex justify-between items-center" >
            <x-back-btn :path="route('backoffice')"/>
            <a href="{{ url('/productTypes/create') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-green-300 hover:text-gray-800 transition-colors duration-300">Add New Type</a>
        </div>

        <div class="bg-white mx-auto w-4/5 rounded shadow-xl p-6 overflow-hidden" style="height: 90%">
            <h1 class="text-3xl">Product Type Manager <small class="text-sm">(showing: {{ count($productTypes) }} types)</small></h1>
            <hr class='mb-3'>

            

            <div class='overflow-scroll p-2' style="height: 100%">

                <table class='border w-full text-center mb-2' style='min-width: 600px'>
                    <thead class="w-full bg-gray-200" style="padding: 5px">
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th># of products</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
    
                        @foreach ($productTypes as $type)
                            <tr class="border-b-2">
                                <td class='p-2'>
                                    <img src="{{ asset($type->image->location) }}" alt="{{ $type->name}}" width='50px' class='mx-auto'>
                                </td>
                                <td class='px-1'>
                                    {{ $type->name }}
                                </td>
                                <td class='p-2'>
                                    {{ $type->slug }}
                                </td>
                                <td class='p-2'>
                                    {{ count($type->products) }}
                                </td>
                                <td class='p-2'>
                                    <x-action-buttons type="productTypes" :identifier="$type->slug"/>
                                </td>
                            </tr>
                        @endforeach
    
                    </tbody>
                </table>

            </div>
            
        </div>
        
    </div>

    
    
</x-app-layout>