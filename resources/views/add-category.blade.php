<x-app-layout>
    <div class="pt-20 pl-6 pr-6" >

        <div class="mx-auto mb-4" style="max-width: 600px">
            <x-back-btn :path="url('/backoffice/categoryManager')"/>
        </div>

        <div class='bg-white mx-auto rounded p-6 shadow-xl' style="max-width: 600px">
            <h1 class='text-2xl mb-2'>Add category page</h1>
            <hr class="mb-6">

            <form action="/backoffice/addCategory" method='POST' enctype="multipart/form-data">
                @csrf

                <!-- Manufacturer -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="manufacturer"  :value="__('Name')" class="sm:w-24" />
                    <x-input id="name" type="text" name="name" :value="old('name')" class="sm:w-9/12" placeholder="e.g 'New Phones'" required autocomplete='off' />
                </div>

                <!-- Model -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-3">
                    <x-label for="slug"  :value="__('Slug')" class="sm:w-24" />
                    <x-input id="slug" type="text" name="slug" :value="old('slug')" class="sm:w-9/12" placeholder="e.g 'new-phones'" required />
                </div>

                <!-- Errors -->
                @error('name')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Name: </span>{{ $message }}</p>
                @enderror
                @error('slug')
                    <p class="text-red-500 text-xs mt-2"><span class='font-bold'>Slug: </span>{{ $message }}</p>
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
        <script type="text/javascript" >
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            nameInput.addEventListener('keyup', () => {
                slugInput.value = nameInput.value.replace(/\s/g, '-').toLowerCase();
            });
        </script>
    @stop
</x-app-layout>