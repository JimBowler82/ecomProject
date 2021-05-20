const operatorSelect = document.getElementById('operator');
const categorySelect = document.getElementById('existingCategory');

operatorSelect.addEventListener('change', () => {
    if(operatorSelect.value === 'root') {
        categorySelect.value = 0;
        return categorySelect.setAttribute('disabled', true);
    }

    categorySelect.removeAttribute('disabled');
});