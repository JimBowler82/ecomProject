<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="pt-20 pl-6 pr-6" >

        <div class="mx-auto mb-4" style="max-width: 600px">
            <x-back-btn :path="route('categories.index')"/>
        </div>

        <div class='bg-white mx-auto rounded p-6 shadow-xl' style="max-width: 600px">
            <h1 class='text-2xl mb-2'>Add category page</h1>
            <hr class="mb-6">

            <form action="/categories" method='POST' enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="name"  :value="__('Name')" class="sm:w-24" />
                    <x-input id="name" type="text" name="name" :value="old('name')" class="sm:w-9/12" placeholder="e.g 'New Phones'" required autocomplete='off' />
                </div>

                <!-- Slug -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="slug"  :value="__('Slug')" class="sm:w-24" />
                    <x-input id="slug" type="text" name="slug" :value="old('slug')" class="sm:w-9/12" placeholder="e.g 'new-phones'" required />
                </div>

                <!-- Hierarchy -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3 pt-3">
                    <x-label for="operator"  :value="__('Nest Category')" class="sm:w-24 sm:self-start" />
                    <div class="flex flex-col sm:w-9/12 ">
                        <div class="flex flex-col sm:flex-row">
                            <select name="operator" id="operator" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-1/4">
                                <option value="root">Root</option>
                                <option value="after">After</option>
                            </select>
                            <select name="existingCategory" id="existingCategory" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:w-3/4" disabled>
                                <option value="0" selected>Select a category as parent</option>
                                @php
                                    $traverse = function ($categories, $prefix = '-') use (&$traverse) {
                                        foreach ($categories as $category) {
                                            
                                            echo "<option value='$category->id'>$prefix $category->name</option>"; 
                                            $traverse($category->children, $prefix.'-');
                                        }
                                    };
    
                                    $traverse($nodes);
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Picture -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3 pt-3">
                    <x-label for="picture"  :value="__('Picture')" class="sm:w-24" />
                    <x-input id="picture" type="file" name="picture" :value="old('picture')" style="border-radius: 0" required />
                    <img id="img-preview" class="hidden" width="50px">
                </div>

                <!-- Errors -->
                @error('name')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Name: </span>{{ $message }}</p>
                @enderror
                @error('slug')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Slug: </span>{{ $message }}</p>
                @enderror
                @error('picture')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Picture: </span>{{ $message }}</p>
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
        <script src="{{ asset('js/add-category.js') }}" ></script>
        <script>

            const operatorSelect = document.getElementById('operator');
            const categorySelect = document.getElementById('existingCategory');

            operatorSelect.addEventListener('change', () => {
                if(operatorSelect.value === 'root') {
                    categorySelect.value = 0;
                }
                categorySelect.toggleAttribute('disabled');
            });
            

            // Image preview
            document.getElementById('picture').addEventListener('change', (e) => {
                const previewImage = document.getElementById('img-preview');
                previewImage.src = URL.createObjectURL(e.target.files[0]);
                previewImage.alt = 'preview image';
                previewImage.classList.remove('hidden');
            });
        </script>
    @stop
</x-app-layout>