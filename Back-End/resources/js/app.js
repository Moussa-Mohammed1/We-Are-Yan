import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const selectors = [
        '[data-animate]',
        '.section-reveal',
        '.glass-panel',
        '.elevated-card',
        'main section',
        'form',
        'aside',
    ];

    const uniqueElements = Array.from(
        new Set(
            selectors.flatMap((selector) => Array.from(document.querySelectorAll(selector)))
        )
    ).filter((element) => !element.closest('[data-no-animate]'));

    uniqueElements.forEach((element) => {
        if (!element.hasAttribute('data-animate') && !element.classList.contains('section-reveal')) {
            element.setAttribute('data-animate', '');
        }
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -8% 0px',
    });

    document.querySelectorAll('[data-animate], .section-reveal, [data-stagger-children]').forEach((element) => {
        observer.observe(element);
    });
});
