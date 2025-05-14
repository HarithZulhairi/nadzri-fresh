// function.js
document.addEventListener('DOMContentLoaded', function() {
    // Add any JavaScript functionality you need here
    console.log('NadzriFresh system loaded');
    
    // Example: Highlight current page in navigation
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.nav-links a');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href').includes(currentPage)) {
            link.classList.add('active');
        }
    });
});