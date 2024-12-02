document.addEventListener('DOMContentLoaded', function () {
    const desktopCards = document.querySelectorAll('.service-card');
    const mobileCards = document.querySelectorAll('.service-card-mobile');
    const desktopSections = document.querySelectorAll('.service-left');
    const mobileSections = document.querySelectorAll('.service-left-mobile');

    const defaultCardDesktop = document.querySelector('.service-card[data-service="mobile"]');
    const defaultCardMobile = document.querySelector('.service-card-mobile[data-service="mobile"]');
    const desktopDefaultSection = document.getElementById('mobile-desktop');
    const mobileDefaultSection = document.getElementById('mobile-mobile');

    // Set default active states
    if (defaultCardDesktop) {
        defaultCardDesktop.classList.add('service-card1');
        if (desktopDefaultSection) {
            desktopDefaultSection.style.display = 'block';
        }
    }

    if (defaultCardMobile) {
        defaultCardMobile.classList.add('service-card1-mobile');
        if (mobileDefaultSection) {
            mobileDefaultSection.style.display = 'block';
        }
    }

    // Function to handle updates
    function updateActiveCard(cards, sections, card, activeClass, isDesktop) {
        cards.forEach(c => c.classList.remove(activeClass));
        sections.forEach(section => (section.style.display = 'none'));

        card.classList.add(activeClass);

        const serviceType = card.getAttribute('data-service');
        const section = isDesktop
            ? document.getElementById(`${serviceType}-desktop`)
            : document.getElementById(`${serviceType}-mobile`);

        if (section) {
            section.style.display = 'block';
        }
    }

    // Add event listeners for desktop cards
    desktopCards.forEach(card => {
        card.addEventListener('click', function () {
            updateActiveCard(desktopCards, desktopSections, card, 'service-card1', true);
        });
    });

    // Add event listeners for mobile cards
    mobileCards.forEach(card => {
        card.addEventListener('click', function () {
            updateActiveCard(mobileCards, mobileSections, card, 'service-card1-mobile', false);
        });
    });
});
