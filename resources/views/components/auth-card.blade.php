<div class="flex flex-col items-center min-h-screen pt-6 pl-2 pr-2 bg-gray-500 sm:justify-center sm:pt-0">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white rounded-lg shadow-md sm:max-w-md">
        {{ $slot }}
    </div>

    <div class="flex items-center justify-between w-full px-6 pt-2 mt-2 sm:max-w-md">
        {{ $options ?? '' }}
    </div>
</div>
