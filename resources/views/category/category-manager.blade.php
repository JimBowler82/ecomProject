<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 h-screen">
        <div class="mx-auto mb-4 w-4/5 lg:w-3/5 flex justify-between items-center" >
            <x-back-btn :path="route('backoffice')"/>
            <a href="/categories/create" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-green-300 hover:text-gray-800 transition-colors duration-300">Add New Category</a>
        </div>

        <div class="bg-white mx-auto w-4/5 lg:w-3/5 rounded shadow-xl p-6 overflow-hidden" style="height: 90%">
            <h1 class="text-3xl">Category Manager <small class="text-sm">(showing: {{ count($categories) }} categories)</small></h1>
            <hr class='mb-3'>

            

            <div class='overflow-scroll p-2' style="height: 100%">

                <table class='border w-full text-center mb-2' style='min-width: 600px'>
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
                                    {{ count($category->products) }}
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

    
</x-app-layout>
