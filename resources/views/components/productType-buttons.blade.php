@props([
    'productTypes'
])

@foreach ($productTypes as $type )
    <a href="/{{ $type->slug }}" class='ml-3 pt-2 px-3 bg-gray-50 hover:bg-green-100 transition-colors duration-300 shadow-lg flex flex-col w-48 flex-none'>
        <div class='shadow-md p-1 bg-white flex-1 flex items-center justify-center'>
            <img src="{{ asset($type->image->location) }}" alt="" class="max-h-32">
        </div>
        <p class="mt-3">{{ $type->name }}</p>
    </a>
@endforeach