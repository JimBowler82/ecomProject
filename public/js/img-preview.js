// Image preview
document.getElementById('picture').addEventListener('change', (e) => {
    const previewImage = document.getElementById('img-preview');
    previewImage.src = URL.createObjectURL(e.target.files[0]);
    previewImage.alt = 'preview image';
    previewImage.classList.remove('hidden');
});