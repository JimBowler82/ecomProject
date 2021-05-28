<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="p-6 mx-auto bg-white rounded-lg shadow-sm"style="max-width: 600px">
                <div class="w-full p-6 text-xl bg-white border-b border-gray-200">
                    <em>Welcome {{ Auth::user()->name }}</em>
                </div>
                <div class='w-4/5 p-4 mx-auto'>
                    <ul class='w-full text-center'>
                        <li class='m-6'><a href="{{ url('/productTypes') }}" class='block px-3 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800'>Product Type Manager</a></li>
                        <li class='m-6'><a href="{{ url('/products') }}" class='block px-3 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800'>Product Manager</a></li>
                        <li class='m-6 '><a href="{{ url('/categories') }}" class='block px-3 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800'>Category Manager</a></li>
                        <li class='m-6 '><a href="{{ url('/orders') }}" class='block px-3 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800'>Order Manager</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
