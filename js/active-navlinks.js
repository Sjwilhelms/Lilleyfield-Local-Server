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

    // Get current path
    const currentPath = window.location.pathname;

    // Handle main navigation
    const allNavLinks = document.querySelectorAll('.navbar-list-flex a, .navbar-list-flex-mobile a, .footer-nav-list a');
    allNavLinks.forEach(link => {
        const href = link.getAttribute('href');
        const isActive =
            href === currentPath ||
            (currentPath.includes('/shop') && href.includes('/shop')) ||
            (currentPath.includes('/cart') && href.includes('/cart')) ||
            (currentPath.includes('/my-account') && href.includes('/my-account')) ||
            (currentPath.includes('/visit') && href.includes('/visit'));

        if (isActive) {
            link.classList.add('active');
            const activeIcon = link.querySelector('.active-icon');
            if (activeIcon) {
                activeIcon.classList.remove('hidden');
            }
            const navItem = link.querySelector('.navbar-item, .navbar-item-mobile');
            if (navItem) {
                navItem.classList.add('active-item');
            }
        }
    });

    // Handle WooCommerce account navigation
    const accountNavLinks = document.querySelectorAll('.woocommerce-MyAccount-navigation-link a');
    accountNavLinks.forEach(link => {
        // Add cheese icon element if it doesn't exist
        if (!link.querySelector('.active-icon')) {
            const iconSpan = document.createElement('span');
            iconSpan.classList.add('active-icon', 'hidden');
            iconSpan.innerHTML = `<img src="/wp-content/themes/storefront-child/assets/cheese_favicon_1.png" alt="active indicator">`;
            link.insertBefore(iconSpan, link.firstChild);
        }

        // Check if this link's parent has the is-active class
        if (link.parentElement.classList.contains('is-active')) {
            const activeIcon = link.querySelector('.active-icon');
            if (activeIcon) {
                activeIcon.classList.remove('hidden');
            }
            link.classList.add('active');
        }
    });
});