document.addEventListener('DOMContentLoaded', function () {
    // Select all desktop and mobile cards and sections
    const desktopCards = document.querySelectorAll('.desktop-section .service-card');
    const mobileCards = document.querySelectorAll('.mobile-section .service-card-mobile');
    const desktopSections = document.querySelectorAll('.desktop-section .service-left');
    const mobileSections = document.querySelectorAll('.mobile-section .service-left-mobile');

    // Function to handle updates for active card and section
    function updateActiveCard(cards, sections, card, activeClass, isDesktop) {
        // Remove active class from all cards and hide all sections
        cards.forEach(c => c.classList.remove(activeClass));
        sections.forEach(section => section.style.display = 'none'); // Hide all sections

        // Add active class to the clicked card
        card.classList.add(activeClass);

        // Get the data-service value to find the relevant section
        const serviceName = card.getAttribute('data-service');
        const targetSection = isDesktop
            ? document.getElementById(`${serviceName}-desktop`)
            : document.getElementById(`${serviceName}-mobile`);

        // Show the relevant section
        if (targetSection) {
            targetSection.style.display = 'block';
        }
    }

    // Initialize the first card and its section to be active on page load (Desktop)
    if (desktopCards.length > 0 && desktopSections.length > 0) {
        const defaultDesktopCard = desktopCards[0];
        const defaultDesktopSectionId = defaultDesktopCard.getAttribute('data-service') + '-desktop';
        const defaultDesktopSection = document.getElementById(defaultDesktopSectionId);
        if (defaultDesktopSection) {
            defaultDesktopCard.classList.add('service-card1');
            defaultDesktopSection.style.display = 'block'; // Show the section for the first card
        }

        // Simulate a click on the first desktop card to set it as active
        defaultDesktopCard.click();
    }

    // Initialize the first card and its section to be active on page load (Mobile)
    if (mobileCards.length > 0 && mobileSections.length > 0) {
        const defaultMobileCard = mobileCards[0];
        const defaultMobileSectionId = defaultMobileCard.getAttribute('data-service') + '-mobile';
        const defaultMobileSection = document.getElementById(defaultMobileSectionId);
        if (defaultMobileSection) {
            defaultMobileCard.classList.add('service-card1-mobile');
            defaultMobileSection.style.display = 'block'; // Show the section for the first card
        }

        // Simulate a click on the first mobile card to set it as active
        defaultMobileCard.click();
    }

    // Add click event listeners for desktop cards
    desktopCards.forEach(card => {
        card.addEventListener('click', function () {
            updateActiveCard(desktopCards, desktopSections, card, 'service-card1', true);
        });
    });

    // Add click event listeners for mobile cards
    mobileCards.forEach(card => {
        card.addEventListener('click', function () {
            updateActiveCard(mobileCards, mobileSections, card, 'service-card1-mobile', false);
        });
    });
});
