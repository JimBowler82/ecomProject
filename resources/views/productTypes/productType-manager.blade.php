<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="h-screen pt-20">
        <div class="flex items-center justify-between w-4/5 mx-auto mb-4" >
            <x-back-btn :path="route('backoffice')"/>
            <a href="{{ url('/productTypes/create') }}" class="px-4 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800">Add New Type</a>
        </div>

        <div class="w-4/5 p-6 mx-auto overflow-hidden bg-white rounded shadow-xl" style="height: 90%">
            <div class="flex flex-col items-center justify-between mb-3 sm:flex-row">
                <h1 class="text-3xl">Product Type Manager <small class="text-sm">(showing: {{ count($productTypes) }} types)</small></h1>
                <x-search-box :action="url('/productTypes')" class="w-full mr-2 sm:w-auto" :placeholder="'Search product types'"/>
            </div>

            <hr class='mb-3'>



            <div class='p-2 overflow-scroll' style="height: 100%">

                <table class='w-full mb-2 text-center border' style='min-width: 600px'>
                    <thead class="w-full bg-gray-200" style="padding: 5px">
                        <th>Name</th>
                        <th>Slug</th>
                        <th># of products</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                        @foreach ($productTypes as $type)
                            <tr class="border-b-2">
                                <td class='px-1'>
                                    {{ $type->name }}
                                </td>
                                <td class='p-2'>
                                    {{ $type->slug }}
                                </td>
                                <td class='p-2'>
                                    {{ $type->products_count }}
                                </td>
                                <td class='p-2'>
                                    <x-action-buttons type="productTypes" :identifier="$type->slug" />
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>

    </div>

    @section('page-script')
        <script src={{ asset('js/action-buttons.js') }}></script>
    @endsection

</x-app-layout>
