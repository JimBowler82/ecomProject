
    
<div class='bg-white flex flex-col items-center p-4 shadow-lg'>
    <img src="{{ $product->picture }}" alt="" width="150px">
    <div class="flex flex-col flex-1 ">
        <h3 class='font-bold mt-2 mb-3'>{{ $product->manufacturer }} <span class='font-normal'>{{ $product->model }}</span> </h3>
        <p class='flex-1'>{{ $product->description }}</p>
        <p class="border-t-2 border-b-2 border-gray-200 mt-3 mb-2 font-bold text-center"><span class='mr-2'>only</span>£{{ $product->price }}</p>
    </div>
    <button class="bg-gray-800 text-white w-full py-1">View</button>
</div>
        
