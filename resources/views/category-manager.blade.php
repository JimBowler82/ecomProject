<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 h-screen">
        <div class="mx-auto mb-4 w-4/5 lg:w-3/5 flex justify-between items-center" >
            <x-back-btn :path="route('backoffice')"/>
            <a href="/backoffice/addCategory" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-green-300 hover:text-gray-800 transition-colors duration-300">Add New Category</a>
        </div>

        <div class="bg-white mx-auto w-4/5 lg:w-3/5 rounded shadow-xl p-6 overflow-hidden" style="height: 90%">
            <h1 class="text-3xl">Category Manager <small class="text-sm">(showing: {{ count($categories) }} categories)</small></h1>
            <hr class='mb-3'>

            

            <div class='overflow-scroll p-2' style="height: 100%">

                <table class='border w-full text-center mb-2' style='min-width: 600px'>
                    <thead class="w-full bg-gray-200" style="padding: 5px">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th># of Products</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
    
                        @foreach ($categories as $category)
                            <tr class="border-b-2">
                                <td class='p-2'>
                                    {{ $category->id }}
                                </td>
                                <td class='p-2'>
                                    {{ $category->name }}
                                </td>
                                <td class='p-2'>
                                    {{ $category->slug }}
                                </td>
                                <td class='p-2'>
                                    {{ count($category->products) }}
                                </td>
                                <td class='p-2'>
                                    <div class='flex justify-evenly'>
                                        <a href='/category/edit/{{ $category->id }}' class="hover:text-green-500 mr-1"><i class="fas fa-edit"></i></a>
                                        <form action="/category/delete/{{ $category->id }}" method="POST" id="delete-form" class="mr-1">
                                            @method('delete')
                                            @csrf
                                            <button type="button" id='delete-btn' class="hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        <a href='/{{ $category->slug }}' class="hover:text-blue-500 mr-1"><i class="fas fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
    
                    </tbody>
                </table>

            </div>
            
        </div>
        
    </div>

    @section('page-script')
        <script type='text/javascript'>
            window.addEventListener('DOMContentLoaded', () => {

                const buttons = document.querySelectorAll('form>button');

                buttons.forEach(button => {

                    button.addEventListener('click', (e) => {

                        if( confirm('Are you sure you want to delete?') ) {
                            return button.parentElement.submit();
                        }

                    });

                });
              
            });
            

        </script>
    @stop
</x-app-layout>
