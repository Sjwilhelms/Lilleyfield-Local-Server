const toggleButton = document.querySelector('.navbar-toggler');
const navbarMenu = document.querySelector('.navbar-list-flex-mobile');

// navbar toggler

toggleButton.addEventListener('click', () => {
    navbarMenu.classList.toggle('active');
});

window.addEventListener('resize', () => {
    if (navbarMenu.classList.contains('active')) {
        navbarMenu.classList.remove('active');
    }
});