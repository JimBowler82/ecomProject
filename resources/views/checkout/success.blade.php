<x-guest-layout>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <h1 class='text-4xl font-bold text-white' style="font-family: 'Playball', cursive; text-shadow: 0px 1px 2px rgba(0,0,0,0.6);" > EcomProject </h1>
            </a>
        </x-slot>

        <div class="flex flex-col items-center mb-4 text-sm text-gray-600">
            <p class="text-xl text-center">
                We appreciate your business! <br >If you have any questions, please email
                <a href="mailto:orders@ecomProject.test" class="font-bold hover:text-blue-500">orders@ecomProject.test</a>.
              </p>
              <a href="{{ url('/') }}" class="px-3 py-2 mt-3 text-lg text-white transition-colors duration-300 bg-gray-800 rounded hover:bg-green-200 hover:text-gray-800">Finish Shopping</a>
        </div>




    </x-auth-card>

</x-guest-layout>
