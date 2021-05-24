<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 pb-6 pl-6 pr-6" >

        <div class="mx-auto mb-4" style="max-width: 600px">
            <x-back-btn :path="route('products.index')"/>
        </div>

        <div class='p-6 mx-auto bg-white rounded shadow-xl' style="max-width: 600px">
            <h1 class='mb-2 text-2xl'>Add product page</h1>
            <hr class="mb-6">

            <form action="/products" method='POST' enctype="multipart/form-data" onChange="generateSlug()" >
                @csrf

                <!-- Product Type -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="productType"  :value="__('Product Type')" class="sm:w-24" />
                    <select name="productType" id="productType" name="productType" value="{{ old('productType') }}" class="border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="" disabled selected>Select a type</option>
                        @foreach ($productTypes as $type )
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ url('productTypes/create') }}" class="text-sm text-blue-500 underline hover:text-gray-800 sm:ml-3">Add new product type</a>
                </div>

                <!-- Manufacturer -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="manufacturer"  :value="__('Manufacturer')" class="sm:w-24" />
                    <x-input id="manufacturer" type="text" name="manufacturer" :value="old('manufacturer')" class="sm:w-9/12" placeholder="e.g 'Apple'" required />
                </div>

                <!-- Model -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="model"  :value="__('Model')" class="sm:w-24" />
                    <x-input id="model" type="text" name="model" :value="old('model')" class="sm:w-9/12" placeholder="e.g 'iPhone 11 Pro'" required />
                </div>

                <!-- Description -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="description"  :value="__('Description')" class="sm:w-24 place-self-start" />

                    <textarea name="description" id="description" rows="5" class="border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:w-9/12" required >{{ old('description') }}</textarea>
                </div>

                <!-- Picture -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="picture"  :value="__('Picture')" class="sm:w-24" />
                    <x-input id="picture" type="file" name="picture" :value="old('picture')" style="border-radius: 0" required />
                    <img alt="preview image" id="img-preview" width="50px" class="hidden">
                </div>

                <!-- Condition -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="condition"  :value="__('Condition')" class="sm:w-24" />
                    <select name="condition" id="condition" class="border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="new">New</option>
                        <option value="refurbished">Refurbished</option>
                    </select>
                </div>

                <!-- Main Category -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">

                    <p class='text-sm font-medium text-gray-700 sm:w-24 place-self-start'>Primary Category</p>

                    <div class="flex flex-col w-9/12">

                        <x-category-dropdown :nodes="$nodes" id="mainCategory" name="mainCategory" class="sm:w-full" />
                        <a href="{{ url('categories/create') }}" class="text-sm text-blue-500 underline hover:text-gray-800 sm:ml-3">Add new category</a>

                    </div>
                </div>

                <!-- Attributes -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <div class="flex flex-col self-start">
                        <x-label :value="__('Attributes')" class="sm:w-24" />
                        <ul id="requiredList" class="pl-6 list-disc">

                        </ul>
                    </div>

                    <x-attributes-form />

                </div>

                <!-- Slug -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="slug"  :value="__('Slug')" class="sm:w-24" />
                    <x-input id="slug" type="text" name="slug" :value="old('slug')" class="sm:w-9/12" placeholder="e.g 'iPhone-11-Pro-unlocked-64gb'" required />
                </div>

                <!-- Price -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="price"  :value="__('Price (£)')" class="sm:w-24" />
                    <x-input id="price" type="number" name="price" :value="old('price')" step="0.01" placeholder="0.00" required />
                </div>

                <!-- Errors -->
                @error('productType')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Product Type: </span>{{ $message }}</p>
                @enderror
                @error('manufacturer')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Manufacturer: </span>{{ $message }}</p>
                @enderror
                @error('model')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Model: </span>{{ $message }}</p>
                @enderror
                @error('description')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Description: </span>{{ $message }}</p>
                @enderror
                @error('picture')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Picture: </span>{{ $message }}</p>
                @enderror
                @error('condition')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Condition: </span>{{ $message }}</p>
                @enderror
                @error('mainCategory')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Main Category: </span>{{ $message }}</p>
                @enderror
                @error('attributes')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Attributes: </span>{{ $message }}</p>
                @enderror
                @error('slug')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Slug: </span>{{ $message }}</p>
                @enderror
                @error('price')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Price: </span>{{ $message }}</p>
                @enderror

                <!-- Form Buttons -->
                <div class="flex flex-row w-11/12 mx-auto mt-10 ">
                    <button type="reset" class="flex-1 px-3 py-2 mr-4 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-red-300 hover:text-gray-800">Clear Form</button>
                    <button type="submit" class="flex-1 px-3 py-2 text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-300 hover:text-gray-800">Submit</button>
                </div>

            </form>


        </div>

    </div>

    @section('page-script')
        <script>
            window.data ={
                "productTypesArray": {!! json_encode($productTypes) !!},
            } ;
        </script>
        <script src="{{ asset('js/product-attributes.js') }}"></script>
        <script src="{{ asset('js/img-preview.js') }}"></script>
        <script src="{{ asset('js/slug-generation.js') }}"></script>
        <script src="{{ asset('js/show-required-attributes.js') }}"></script>
    @endsection
</x-app-layout>
