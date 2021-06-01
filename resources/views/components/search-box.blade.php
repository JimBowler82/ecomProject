@props([
    'action',
    'placeholder'
])

<form action="{{ $action }}" method="GET" {!! $attributes->merge(['class' => '']) !!}>
    <div class="flex items-center border border-gray-200 rounded-md ">
        <span class="flex items-center self-stretch p-2 bg-white rounded-tl-md rounded-bl-md"><i class="fas fa-search"></i></span>
        <x-input type="search" name="search" class="border-none rounded-tl-none rounded-bl-none" value="{{ request('search') }}" placeholder="{{ $placeholder }}"/>
    </div>
</form>
