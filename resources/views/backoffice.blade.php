<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-xl">
                    <em>Welcome {{ Auth::user()->name }}</em>
                </div>
                <div class='p-4 w-3/12'>
                    <ul class='w-full text-center'>
                        <li class='m-6'><a href="/backoffice/addProduct" class='bg-gray-800 rounded text-white px-3 py-2 block hover:bg-green-300 hover:text-gray-800 transition-colors duration-300'>Add Product</a></li>
                        <li class='m-6 '><a href="" class='bg-gray-800 rounded text-white px-3 py-2 block hover:bg-green-300 hover:text-gray-800 transition-colors duration-300'>Add Category</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
