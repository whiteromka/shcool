// resources/js/swiper-faq.js

import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function () {

    const container = document.querySelector('.mySwiper');
    if (!container) return;

    new Swiper(container, {

        modules: [Navigation, Pagination, Autoplay],

        slidesPerView: 'auto',
        spaceBetween: 30,
        centeredSlides: true,
        grabCursor: true,
        loop: true,
        speed: 1800,

        autoplay: {
            delay: 7000,
            disableOnInteraction: true,
            pauseOnMouseEnter: true,
        },

        pagination: {
            el: container.querySelector('.swiper-pagination'),
            type: 'progressbar',
        },

        navigation: {
            nextEl: container.querySelector('.swiper-button-next'),
            prevEl: container.querySelector('.swiper-button-prev'),
        },

        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 20 },
            768: { slidesPerView: 'auto', spaceBetween: 25 },
            992: { slidesPerView: 'auto', spaceBetween: 30 }
        }
    });
});
