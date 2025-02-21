document.addEventListener('DOMContentLoaded', function() {
    // Check if the user is navigating from within your site
    const referrer = document.referrer;
    const isSameOrigin = referrer.startsWith(window.location.origin);

    if (isSameOrigin) {
        // User is navigating from within the site - hide the hero video
        const heroContainer = document.querySelector('.video-container');
        if (heroContainer) {
            heroContainer.style.display = 'none';
        }
    } else {
        // Direct visitor or external referrer - show the hero video
        const heroContainer = document.querySelector('.video-container');
        if (heroContainer) {
            heroContainer.style.display = 'block';
        }
    }
});