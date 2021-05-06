<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-500 pl-2 pr-2">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
        {{ $slot }}
    </div>

    <div class="w-full sm:max-w-md mt-2 px-6 pt-2 flex justify-between items-center">
        {{ $options }}
    </div>
</div>
