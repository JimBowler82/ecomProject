

<div class='flex flex-col items-center flex-1 p-4 m-4 bg-white shadow-lg' style="max-width: 350px; min-width: 300px;">
    <div class='flex items-center justify-center h-3/5'>
        <img src="{{ Storage::url($product->images->first()->location ?? 'images/default-avatar.jpeg') }}" alt="" width="80%">
    </div>
    <div class="flex flex-col flex-1 w-full ">
        <h3 class='mt-4 mb-2 font-bold'>{{ $product->manufacturer }} <span class='font-normal'>{{ $product->model }}</span> </h3>
        <p class='mb-2'><span class='font-bold'>Condition: </span> {{ $product->condition }}</p>
        <div class="flex flex-wrap">
            @foreach ($product->attributes as $type => $value )
                <p class="mr-2"><span class='text-sm font-bold capitalize'>{{ $type }}:</span> {{ $value }}</p>
            @endforeach
        </div>
        <p class="mt-3 mb-2 font-bold text-center border-t-2 border-b-2 border-gray-200"><span class='mr-2'>only</span>£{{ number_format($product->price / 100, 2, '.', '')  }}</p>
    </div>
    <a href="/products/{{ $product->slug }}" class="w-full py-1 text-center text-white transition-colors duration-300 bg-gray-800 hover:bg-green-300 hover:text-gray-800 hover:font-bold">View</a>
</div>

