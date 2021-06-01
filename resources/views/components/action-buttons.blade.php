@props([
    'identifier',
    'type'
])

<div {!! $attributes->merge(['class' => 'flex justify-evenly']) !!} >

    <!-- Edit Button -->
    <a href="/{{ $type }}/{{ $identifier }}/edit" class="mr-1 hover:text-green-500"><i class="fas fa-edit"></i></a>

    <!-- Delete Button-->
    <form action="/{{ $type }}/{{ $identifier }}" method="POST" class="mr-1">
        @method('delete')
        @csrf
        <button type="button" class="hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
    </form>

    <!-- View Button -->
    @if ($type == 'productTypes')
        <a href='/{{ $identifier }}' class="hover:text-blue-500"><i class="fas fa-eye"></i></a>
    @else
        <a href='/{{ $type }}/{{ $identifier }}' class="hover:text-blue-500"><i class="fas fa-eye"></i></a>
    @endif

</div>


