@props([
    'categories',
    
])

@if (empty($categories->toArray()))
    <a href="/" class='inline-block bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Home</a>
@endif

@foreach ($categories as $category )
    <a href="/categories/{{ $category->slug }}" class='inline-block bg-white px-2 py-1 rounded font-bold hover:bg-green-300 mt-2 mr-3 transition-all duration-300 ' >{{ $category->name }}</a>

    @if(($loop->last && !$category->isRoot()))
        <a href="/" class='inline-block bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Home</a>
    @endif

@endforeach


    
