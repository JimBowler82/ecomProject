const nameInput = document.getElementById('name');
const slugInput = document.getElementById('slug');

nameInput.addEventListener('keyup', () => {
    slugInput.value = nameInput.value.replace(/\s/g, '-').toLowerCase();
});