window.addEventListener('DOMContentLoaded', () => {
    const condition = {!! json_encode($product->condition) !!}
    const options = document.querySelectorAll('#condition > option');
    options.forEach(option => {
        if (option.value === condition) {
            option.selected = true
        } 
    })
});