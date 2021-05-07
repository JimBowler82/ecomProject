<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 pl-6 pr-6 bg-gray-500 pb-3" >

        <div class="mx-auto mb-4" style="max-width: 600px">
            <x-back-btn :path="route('products.index')"/>
        </div>

        <div class='bg-white mx-auto rounded p-6 shadow-xl' style="max-width: 600px">
            <h1 class='text-2xl mb-2'>Edit product page</h1>
            <hr class="mb-6">

            <form action="/products/{{$product->id}}" method='POST' enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Manufacturer -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="manufacturer"  :value="__('Manufacturer')" class="sm:w-24" />
                    <x-input id="manufacturer" type="text" name="manufacturer" :value="$product->manufacturer" class="sm:w-9/12" required />
                    
                </div>

                <!-- Model -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="model"  :value="__('Model')" class="sm:w-24" />
                    <x-input id="model" type="text" name="model" :value="$product->model" class="sm:w-9/12" required />
                </div>
                

                <!-- Description -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="description"  :value="__('Description')" class="sm:w-24 place-self-start" />
                    <textarea name="description" id="description" rows="5" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:w-9/12" required >{{ $product->description }}</textarea>
                </div>
                


                <!-- Picture -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3  ">
                    <x-label for="picture"  :value="__('Picture')" class="sm:w-24" />
                    <x-input id="picture" type="file" name="picture" :value="old('picture')" style="border-radius: 0" />
                    <img src="{{asset($product->images->first()->location)}}" width="50px">
                </div>

                <!-- Condition -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="condition"  :value="__('Condition')" class="sm:w-24" />
                    <select name="condition" id="condition" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="" disabled>Select an option</option>
                        <option value="new">New</option>
                        <option value="refurbished">Refurbished</option>
                    </select>
                </div>

                <!-- Categories checkbox -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">

                    <p class='font-medium text-sm text-gray-700 sm:w-24 place-self-start'>Categories</p>

                    <div class='mb-3 flex flex-wrap p-4 border border-gray-300 rounded-md'>

                        @if($categories)
                            @foreach ($categories as $category )
                            <div class='w-2/6 mb-3'>
                                <x-label for="{{ $category->slug }}" value="{{ $category->name }}" />
                                <x-input type="checkbox" name="categories[]" id="{{ $category->slug }}" value="{{ $category->id }}"  :checked="$product->categories->contains($category) ? true : false " />
                            </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                
                <!-- Price -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="price"  :value="__('Price (£)')" class="sm:w-24" />
                    <x-input id="price" type="number" name="price" :value="number_format($product->price / 100, 2, '.', '') " step="0.01" placeholder="0.00" required />
                </div>

                <!-- Errors -->
                @error('manufacturer')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Manufacturer: </span>{{ $message }}</p>
                @enderror
                @error('model')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Model: </span>{{ $message }}</p>
                @enderror
                @error('description')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Description: </span>{{ $message }}</p>
                @enderror
                @error('picture')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Picture: </span>{{ $message }}</p>
                @enderror
                @error('condition')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Condition: </span>{{ $message }}</p>
                @enderror
                @error('categories')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Categories: </span>{{ $message }}</p>
                @enderror
                @error('price')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Price: </span>{{ $message }}</p>
                @enderror

                <!-- Form Buttons -->
                <div class=" w-11/12 flex flex-row mt-10 mx-auto">
                    <button type="reset" class="bg-gray-800 text-white rounded px-3 py-2 flex-1 mr-4 hover:bg-red-300 hover:text-gray-800 transition-colors duration-300">Clear Form</button>
                    <button type="submit" class="bg-gray-800 text-white rounded px-3 py-2 flex-1 hover:bg-green-300 hover:text-gray-800 transition-colors duration-300">Update</button>
                </div>

            </form>
            
            
        </div>
        
    </div>
    @section('page-script')
        <script >
            window.addEventListener('DOMContentLoaded', () => {
                const condition = {!! json_encode($product->condition) !!}
                const options = document.querySelectorAll('#condition > option');
                options.forEach(option => {
                    if (option.value === condition) {
                        option.selected = true
                    } 
                })
            });
        </script>
    @stop
</x-app-layout>