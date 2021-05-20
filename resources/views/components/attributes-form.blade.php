<div class="rounded-md flex justify-between w-8/12 flex-wrap" >
    <div id="container" class="w-full p-1 flex flex-wrap "></div>
    <input type="hidden" id="attributes" name="attributes" value="{{ old('attributes') }}">
    <x-input id="attr-key" type="text" name="attr-key" :value="old('attr-key')" class="sm:w-1/3 " placeholder="e.g 'Storage'" />
    <x-input id="attr-val" type="text" name="attr-val" :value="old('attr-val')" class="sm:w-1/3" placeholder="e.g '64gb'" />
    <button type="button" class="bg-blue-500 text-white sm:w-1/5 rounded" id="add">Add</button>
</div>