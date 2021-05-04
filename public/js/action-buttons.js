window.addEventListener('DOMContentLoaded', () => {

    const buttons = document.querySelectorAll('form>button');

    buttons.forEach(button => {

        button.addEventListener('click', (e) => {

            if( confirm('Are you sure you want to delete?') ) {
                return button.parentElement.submit();
            }

        });

    });
  
});