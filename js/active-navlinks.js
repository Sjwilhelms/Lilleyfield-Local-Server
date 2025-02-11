document.addEventListener('DOMContentLoaded', function() {
    // First, hide all cheese icons by default
    const allIcons = document.querySelectorAll('.active-icon');
    allIcons.forEach(icon => {
        icon.classList.add('hidden');
    });

    // Mobile menu toggle
    const menuToggler = document.querySelector('.navbar-toggler');
    const mobileMenu = document.querySelector('.navbar-list-flex-mobile');

    if (menuToggler && mobileMenu) {
        menuToggler.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Active state handling for both desktop and mobile
    const currentPath = window.location.pathname;
    const allNavLinks = document.querySelectorAll('.navbar-list-flex a, .navbar-list-flex-mobile a, .footer-nav-list a');

    allNavLinks.forEach(link => {
        const href = link.getAttribute('href');

        // More specific path matching
        const isActive =
            href === currentPath ||
            (currentPath.includes('/shop') && href.includes('/shop')) ||
            (currentPath.includes('/cart') && href.includes('/cart')) ||
            (currentPath.includes('/my-account') && href.includes('/my-account')) ||
            (currentPath.includes('/visit') && href.includes('/visit'));

        if (isActive) {
            // Add active class to link
            link.classList.add('active');

            // Show cheese icon by removing hidden class
            const activeIcon = link.querySelector('.active-icon');
            if (activeIcon) {
                activeIcon.classList.remove('hidden');
            }

            // Add active styles to the list item
            const navItem = link.querySelector('.navbar-item, .navbar-item-mobile');
            if (navItem) {
                navItem.classList.add('active-item');
            }
        }
    });
});