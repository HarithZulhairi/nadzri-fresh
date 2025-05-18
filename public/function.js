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

function confirmDelete(publicationId) {
    var result = confirm("Are you sure you want to delete this publication?");
    if (result) {
        document.getElementById('deleteForm_' + publicationId).submit();
    }
    return false; // Prevent the form from submitting automatically
}

function toggleNotifications() {
    const dropdown = document.querySelector('.notification-dropdown');
    dropdown.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const notificationContainer = document.querySelector('.notification-container');
    if (!notificationContainer.contains(event.target)) {
        document.querySelector('.notification-dropdown').classList.remove('show');
    }
});