document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('.dark-mode-toggle');

    toggleButton.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('dark-mode-body');
    });
});
