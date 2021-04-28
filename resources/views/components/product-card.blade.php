
    
<div class='flex-1 bg-white flex flex-col items-center p-4 m-4 shadow-lg' style="max-width: 350px; min-width: 300px;">
    <div class='h-3/5 flex items-center justify-center'>
        <img src="{{ asset($product->picture) }}" alt="" width="80%">
    </div>
    <div class="flex flex-col flex-1 w-full ">
        <h3 class='font-bold mt-2 mb-2'>{{ $product->manufacturer }} <span class='font-normal'>{{ $product->model }}</span> </h3>
        <p class='mb-2'><span class='font-bold'>Condition: </span> {{ $product->condition }}</p>
        <p class='flex-1'>{{ $product->description }}</p>
        <p class="border-t-2 border-b-2 border-gray-200 mt-3 mb-2 font-bold text-center"><span class='mr-2'>only</span>£{{ $product->price }}</p>
    </div>
    <a href="/product/{{ $product->id }}" class="bg-gray-800 text-center hover:bg-green-300 hover:text-gray-800 hover:font-bold text-white w-full py-1 transition-colors duration-300">View</a>
</div>
        
