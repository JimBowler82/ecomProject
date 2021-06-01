<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="h-screen pt-20">
        <div class="flex items-center justify-between w-4/5 mx-auto mb-4 lg:w-3/5" >
            <x-back-btn :path="route('backoffice')"/>
            <a href="/categories/create" class="px-4 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800">Add New Category</a>
        </div>

        <div class="w-4/5 p-6 mx-auto overflow-hidden bg-white rounded shadow-xl lg:w-3/5" style="height: 90%">
            <div class="flex flex-col items-center justify-between mb-3 sm:flex-row">
                <h1 class="text-3xl">Category Manager <small class="text-sm">(showing: {{ count($categories) }} categories)</small></h1>
                <x-search-box :action="url('/categories')" class="w-full mr-2 sm:w-auto" :placeholder="'Search categories'" />
            </div>

            <hr class='mb-3'>



            <div class='p-2 overflow-scroll' style="height: 100%">

                <table class='w-full mb-2 text-center border' style='min-width: 600px'>
                    <thead class="w-full bg-gray-200" style="padding: 5px">
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Path</th>
                        <th># of Products</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr class="border-b-2">
                                <td class='p-2'>
                                    <img src="{{ Storage::url($category->image->location ?? 'images/default-avatar.jpeg') }}" alt="{{ $category->name}}" width='50px' class='mx-auto'>
                                </td>
                                <td class='p-2'>
                                    {{ str_repeat('-', $category->depth).$category->name }}
                                </td>
                                <td class='p-2'>
                                    {{ $category->slug }}
                                </td>
                                <td class='p-2 text-xs'>
                                    {{ $category->full_slug_path }}
                                </td>
                                <td class='p-2'>
                                    {{  $category->total_number_of_nested_products  }}
                                </td>
                                <td class='p-2'>
                                    <x-action-buttons type="categories" :identifier="$category->slug"/>
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
