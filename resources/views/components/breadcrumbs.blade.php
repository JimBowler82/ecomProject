@props([
    'ancestors',
])

<ul class="flex mb-3">
    <li>
        <a href="/" class="hover:text-green-300 transition-all duration-300">Home</a> |
    </li>
    @foreach ($ancestors as $ancestor)

        @if ($loop->last)
            <li class="ml-1">
                <a href="{{ $ancestor->full_slug_path }}" class="underline hover:text-green-300 transition-all duration-300">{{ $ancestor->name }}</a> 
            </li>
        @else
            <li class="ml-1">
                <a href="{{ $ancestor->full_slug_path }}" class="hover:text-green-300 transition-all duration-300">{{ $ancestor->name }}</a> |
            </li>
        @endif
  
    @endforeach
</ul>