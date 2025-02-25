const toggleButton = document.querySelector('.navbar-toggler');
const navbarMenu = document.querySelector('.header-navigation-wrapper');

// navbar toggler

function checkWidth() {
    if (window.innerWidth <= 1000) {
        // Below breakpoint - make sure menu is hidden by default
        navbarMenu.classList.add('hidden');
    } else {
        // Above breakpoint - make sure menu is visible
        navbarMenu.classList.remove('hidden');
    }
}

toggleButton.addEventListener('click', () => {
    navbarMenu.classList.toggle('hidden');
});

window.addEventListener('resize', () => {
    if (navbarMenu.classList.contains('hidden')) {
        navbarMenu.classList.remove('hidden');
    }
});