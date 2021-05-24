<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 pl-6 pr-6" >

        <div class="mx-auto mb-4" style="max-width: 600px">
            <x-back-btn :path="url()->previous()"/>
        </div>

        <div class='p-6 mx-auto bg-white rounded shadow-xl' style="max-width: 600px">
            <h1 class='mb-2 text-2xl'>Add product type page</h1>
            <hr class="mb-6">

            <form action="/productTypes" method='POST' enctype="multipart/form-data">
                @csrf

                <!-- Product Type Name -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="name"  :value="__('Name')" class="sm:w-24" />
                    <x-input id="name" type="text" name="name" :value="old('name')" class="sm:w-9/12" placeholder="e.g 'Refurbished Headphones'" required autocomplete='off' />
                </div>

                <!-- Product Type Slug -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="slug"  :value="__('Slug')" class="sm:w-24" />
                    <x-input id="slug" type="text" name="slug" :value="old('slug')" class="sm:w-9/12" placeholder="e.g 'refurbished-headphones'" required />
                </div>

                <!-- Product Type Attributes -->
                <div class="flex flex-col mb-3 sm:flex-row sm:items-center">
                    <x-label for="attributes"  :value="__('Attributes')" class="sm:w-24" />
                    <input type="hidden" id="properties" name="properties" value="{{ old('properties') }}">
                    <div class="w-9/12">
                        <div id="collection" class="p-1 text-green-800 bg-gray-300"></div>
                        <x-input id="attributes" name="attributes" type="text" class="w-full" :value="old('attributes')" />
                    </div>
                </div>

                <!-- Errors -->
                @error('name')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Name: </span>{{ $message }}</p>
                @enderror
                @error('slug')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Slug: </span>{{ $message }}</p>
                @enderror
                @error('properties')
                    <p class="mt-2 text-xs text-red-500"><span class='font-bold'>Properties: </span>{{ $message }}</p>
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
        <script src="{{ asset('js/add-category.js') }}" ></script>
        <script src="{{ asset('js/product-types.js') }}" }}></script>
    @stop
</x-app-layout>
