<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 pl-6 pr-6 pb-6" >

        <div class="mx-auto mb-4" style="max-width: 600px">
            <x-back-btn :path="route('products.index')"/>
        </div>

        <div class='bg-white mx-auto rounded p-6 shadow-xl' style="max-width: 600px">
            <h1 class='text-2xl mb-2'>Add product page</h1>
            <hr class="mb-6">

            <form action="/products" method='POST' enctype="multipart/form-data">
                @csrf

                <!-- Product Type -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="productType"  :value="__('Product Type')" class="sm:w-24" />
                    <select name="productType" id="productType" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="" disabled selected>Select a type</option>
                        @foreach ($productTypes as $type )
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ url('productTypes/create') }}" class="text-sm text-blue-500 underline hover:text-gray-800 sm:ml-3">Add new product type</a>
                </div>

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

                <!-- Attributes -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label   :value="__('Attributes')" class="sm:w-24" />
                    <div class="rounded-md flex justify-between w-8/12 flex-wrap">
                        <div id="container" class="w-full p-1 flex flex-wrap "></div>
                        <input type="hidden" id="attributes" name="attributes" >
                        <x-input id="attr-key" type="text" name="attr-key" :value="old('attr-key')" class="sm:w-1/3 " placeholder="" />
                        <x-input id="attr-val" type="text" name="attr-val" :value="old('attr-val')" class="sm:w-1/3" placeholder="" />
                        <button class="bg-blue-500 text-white sm:w-1/5 rounded" id="add">Add</button>
                    </div>
                </div>
                
                <!-- Price -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="price"  :value="__('Price (£)')" class="sm:w-24" />
                    <x-input id="price" type="number" name="price" :value="old('price')" step="0.01" placeholder="0.00" required />
                </div>

                <!-- Errors -->
                @error('productType')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Product Type: </span>{{ $message }}</p>
                @enderror
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
                    <button type="submit" class="bg-gray-800 text-white rounded px-3 py-2 flex-1 hover:bg-green-300 hover:text-gray-800 transition-colors duration-300">Submit</button>
                </div>

            </form>
            
            
        </div>
        
    </div>

    @section('page-script')
        <script type="text/javascript">
            let attributes = {};

            window.addEventListener('DOMContentLoaded', () => {

                document.getElementById('add').addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    const container = document.getElementById('container');
                    const key = e.target.parentNode.childNodes[5].value.toLowerCase().trim();
                    const value = e.target.parentElement.childNodes[7].value.toLowerCase().trim();

                    if(key && value) {

                        attributes = {...attributes, [key] : value};

                        document.getElementById('attributes').value = JSON.stringify(attributes);

                        e.target.parentNode.childNodes[5].value = '';
                        e.target.parentNode.childNodes[5].focus();
                        e.target.parentElement.childNodes[7].value = '';

                        displayAttributes(attributes);
                    }
                          
                });

            });

            function displayAttributes(obj) {

                document.getElementById('container').innerHTML = '';
                attributesArray = Object.entries(obj);

                attributesArray.forEach(attribute => {
                    
                    const div = document.createElement('div');
                    const p = document.createElement('p');
                    const button = document.createElement('button');

                    div.classList = "inline p-1 m-1 shadow bg-gray-100 flex text-sm";
                    p.classList = "capitalize";
                    button.classList = "text-red-500 ml-2 font-bold";

                    p.innerHTML = `<strong>${attribute[0]}:</strong> ${attribute[1]}`;
                    button.innerText = "X";
                    
                    button.setAttribute('onclick', `remove("${attribute[0]}")`);

                    div.appendChild(p);
                    div.appendChild(button);
                    container.appendChild(div);
                });
            }

            function remove(key) {
                event.preventDefault();

                delete attributes[key];
                event.target.parentNode.remove();
                  
            }
        </script>
    @endsection
</x-app-layout>