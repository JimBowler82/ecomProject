<x-app-layout>
    <div class="pt-20 pl-6 pr-6" >

        <div class="mx-auto mb-4" style="max-width: 600px">
            <x-back-btn :path="route('backoffice')"/>
        </div>

        <div class='bg-white mx-auto rounded p-6 shadow-xl' style="max-width: 600px">
            <h1 class='text-2xl mb-2'>Add product page</h1>
            <hr class="mb-6">

            <form action="/backoffice/addProduct" method='POST' enctype="multipart/form-data">
                @csrf

                <!-- Manufacturer -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="manufacturer"  :value="__('Manufacturer')" class="sm:w-24" />
                    <x-input id="manufacturer" type="text" name="manufacturer" :value="old('manufacturer')" class="sm:w-9/12" placeholder="e.g 'Apple'" required />
                </div>

                <!-- Model -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="model"  :value="__('Model')" class="sm:w-24" />
                    <x-input id="model" type="text" name="model" :value="old('model')" class="sm:w-9/12" placeholder="e.g 'iPhone 11 Pro'" required />
                </div>

                <!-- Description -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="description"  :value="__('Description')" class="sm:w-24 place-self-start" />
                    
                    <textarea name="description" id="description" value="{{ old('description') }}"  rows="5" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:w-9/12" required ></textarea>
                </div>

                <!-- Picture -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="picture"  :value="__('Picture')" class="sm:w-24" />
                    <x-input id="picture" type="file" name="picture" :value="old('picture')" style="border-radius: 0" required />
                </div>

                <!-- Condition -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="condition"  :value="__('Condition')" class="sm:w-24" />
                    <select name="condition" id="condition" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="" disabled selected>Select an option</option>
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
                                <x-input type="checkbox" name="categories[]" id="{{ $category->slug }}" value="{{ $category->id }}" />
                            </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                
                
                

                <!-- Price -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="price"  :value="__('Price (£)')" class="sm:w-24" />
                    <x-input id="price" type="number" name="price" :value="old('price')" step="0.01" placeholder="0.00" required />
                </div>

                <!-- Form Buttons -->
                <div class=" w-11/12 flex flex-row mt-10 mx-auto">
                    <button type="reset" class="bg-gray-800 text-white rounded px-3 py-2 flex-1 mr-4 hover:bg-red-300 hover:text-gray-800 transition-colors duration-300">Clear Form</button>
                    <button type="submit" class="bg-gray-800 text-white rounded px-3 py-2 flex-1 hover:bg-green-300 hover:text-gray-800 transition-colors duration-300">Submit</button>
                </div>

            </form>
            
            
        </div>
        
    </div>
</x-app-layout>