@props([
    'nodes',
])

<select {{ $attributes->merge(['class' => 'rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }} >
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