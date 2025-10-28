document.addEventListener('DOMContentLoaded', () => {
    const confirmForms = document.querySelectorAll('form.needs-confirm');
    confirmForms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            const message = form.getAttribute('data-confirm-message') || 'Are you sure?';
            if (!window.confirm(message)) {
                event.preventDefault();
            }
        });
    });
});
