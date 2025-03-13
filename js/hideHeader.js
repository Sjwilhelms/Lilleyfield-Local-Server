function hideHeaderOnAboutPage() {
    // Check if we're on the About page - modify this selector as needed for your site
    if (document.body.classList.contains('page-id-135') ||
        document.body.classList.contains('about-page') ||
        window.location.pathname.includes('/about/')) {

        // Find the header element and hide it
        const header = document.querySelector('.site-header');
        if (header) {
            header.style.display = 'none';
        }
    }
}

// Run the function when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', hideHeaderOnAboutPage);