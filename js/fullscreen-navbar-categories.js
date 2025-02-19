document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdown parents
    const dropdownParents = document.querySelectorAll('.dropdown-parent');

    // Account and shop dropdown toggle
    dropdownParents.forEach(parent => {
        const toggleLink = parent.querySelector('.account-toggle, .shop-toggle');
        const dropdownMenu = parent.querySelector('.dropdown-menu');

        if (toggleLink && dropdownMenu) {
            toggleLink.addEventListener('click', function(e) {
                // Check if clicking the arrow or link itself (not an image inside)
                if (e.target.classList.contains('dropdown-arrow') ||
                    e.target === this) {
                    e.preventDefault();

                    // Toggle the dropdown
                    const isOpen = parent.classList.contains('dropdown-open');

                    // Close all dropdowns
                    dropdownParents.forEach(item => {
                        item.classList.remove('dropdown-open');
                        const menu = item.querySelector('.dropdown-menu');
                        if (menu) {
                            menu.style.display = 'none';
                        }
                    });

                    // If this wasn't open, open it (toggle behavior)
                    if (!isOpen) {
                        parent.classList.add('dropdown-open');
                        dropdownMenu.style.display = 'block';
                    }
                }
            });
        }
    });

    // Subcategory toggle in category dropdown
    const subcategoryToggles = document.querySelectorAll('.has-children > a');
    subcategoryToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            // Only prevent default if clicked on the arrow
            if (e.target.classList.contains('submenu-arrow')) {
                e.preventDefault();

                const parent = this.parentElement;
                const subDropdown = this.nextElementSibling;

                parent.classList.toggle('submenu-open');
                subDropdown.style.display = parent.classList.contains('submenu-open') ? 'block' : 'none';
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-parent')) {
            dropdownParents.forEach(parent => {
                parent.classList.remove('dropdown-open');
                const menu = parent.querySelector('.dropdown-menu');
                if (menu) {
                    menu.style.display = 'none';
                }
            });
        }
    });
});