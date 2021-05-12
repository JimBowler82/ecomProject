@props([
    'categories',
    'productType',
    'active'
])

@foreach ($categories as $category )
    <a href="/{{ $productType->slug }}/{{ $category->slug }}" class='inline-block bg-white px-2 py-1 rounded font-bold hover:bg-green-300 mt-2 mr-3 transition-all duration-300 {{ isset($active) && $active == $category->slug ?  'bg-green-300':''}}' >{{ $category->name }}</a>
@endforeach
@if ($active)
    <a href="/{{ $productType->slug }}" class='inline-block bg-gray-800 text-white px-2 py-1 rounded  font-bold hover:bg-green-300 hover:text-gray-800 mt-2 mr-3 transition-all duration-300'>Show All</a>
@endif