<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg mx-auto p-6"style="max-width: 600px">
                <div class="p-6 bg-white border-b border-gray-200 text-xl w-full">
                    <em>Welcome {{ Auth::user()->name }}</em>
                </div>
                <div class='p-4 w-4/5 mx-auto'>
                    <ul class='w-full text-center'>
                        <li class='m-6'><a href="/backoffice/addProduct" class='bg-gray-800 rounded text-white px-3 py-2 block hover:bg-green-300 hover:text-gray-800 transition-colors duration-300'>Add Product</a></li>
                        <li class='m-6 '><a href="/backoffice/addCategory" class='bg-gray-800 rounded text-white px-3 py-2 block hover:bg-green-300 hover:text-gray-800 transition-colors duration-300'>Add Category</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
