// date-search.js

const datePicker = document.getElementById('date_search');
datePicker.addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
        datePicker.closest('form').submit();
    }
});

const close = document.getElementById('close');
close?.addEventListener('click', () => {
    datePicker.value = '';
    window.location.href = "/orders";

})
