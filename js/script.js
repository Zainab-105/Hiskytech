document.addEventListener('DOMContentLoaded', function () {
    const serviceCards = document.querySelectorAll('.service-card');
    const serviceLeftSections = document.querySelectorAll('.service-left');
    const defaultCard = document.querySelector('[data-service="mobile"]');
    defaultCard.classList.remove('.service-card');
    const defaultSection = document.getElementById('mobile');
    defaultCard.classList.add('service-card1');
    defaultSection.style.display = 'block';
    function updateActiveCard(card) {
        serviceCards.forEach(c => c.classList.remove('service-card1'));
        card.classList.add('service-card1');
      
        // Hide all service-left sections
        serviceLeftSections.forEach(section => section.style.display = 'none');

        // Show the section corresponding to the clicked card
        const serviceType = card.getAttribute('data-service');
        const serviceLeft = document.getElementById(serviceType);
        if (serviceLeft) {
            serviceLeft.style.display = 'block';
        }
    }

    // Attach click event listeners to all service cards
    serviceCards.forEach(card => {
        card.addEventListener('click', function () {
            updateActiveCard(card);
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    // Get all team cards
    const teamCards = document.querySelectorAll('.team-card');

    teamCards.forEach(card => {
        const frontImg = card.querySelector('.front-img');
        const backImg = card.querySelector('.back-img');

        // Add event listeners for hover functionality
        card.addEventListener('mouseenter', function () {
            frontImg.style.transform = 'translate(-50%, -50%) scale(0.6)'; // Zoom out to center
            frontImg.style.opacity = '0'; // Fade out the front image
            backImg.style.opacity = '1'; // Fade in the back image
        });

        card.addEventListener('mouseleave', function () {
            frontImg.style.transform = 'translate(-50%, -50%) scale(1)'; // Reset the scale
            frontImg.style.opacity = '1'; // Show front image
            backImg.style.opacity = '0'; // Hide back image
        });
    });
});
