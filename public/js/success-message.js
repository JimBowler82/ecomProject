window.addEventListener('DOMContentLoaded', () => {
    
    const alert = document.querySelector('.alert');
    const alertBtn = document.getElementById('alert-btn');

    if(alert) {
        console.log('message');
        alertBtn.addEventListener('click', () => {
            alert.style.display = 'none';
        })

        alert.style.visibility = 'hidden';
        setTimeout(() => {
            alert.style.opacity = 0;
        }, 1500);
    }
});