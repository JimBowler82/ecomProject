@props([
    'categories',
    'parentPath',
])

    
@forelse ($categories as $category)

    <a href="/{{ $category->slug }}" class='ml-3 pt-2 px-3 bg-gray-50 hover:bg-green-100 transition-colors duration-300 shadow-lg flex flex-col w-48 flex-none'>
        <div class='shadow-md p-1 bg-white flex-1 flex items-center justify-center'>
            <img src="{{ asset($category->image->location ?? 'images/default-avatar.jpeg') }}" alt="" class="max-h-32">
        </div>
        <p class="mt-3">{{ $category->name }}</p>
    </a>
    
@empty

    <a href="/" class=' self-center bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Homepage</a>
    <span class="self-center pt-2">No more categories</span>
    
@endforelse