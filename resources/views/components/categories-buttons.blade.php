@props([
    'categories',
    'parentPath',
])

    
@forelse ($categories as $category)

    <a href="{{ $category->full_slug_path }}" class='inline-block bg-white px-2 py-1 rounded font-bold hover:bg-green-300 mt-2 mr-3 transition-all duration-300 ' >{{ $category->name }}</a>
    
    @if(($loop->last && !$category->isRoot()))
        <a href="{{ $parentPath }}" class='inline-block bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Back</a>
    @endif

@empty

    <a href="{{ $parentPath }}" class='inline-block bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Back</a>

@endforelse