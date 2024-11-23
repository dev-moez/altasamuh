import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import { Notify } from 'notiflix/build/notiflix-notify-aio';
import { HSStaticMethods } from "preline/preline";
import { HSSelect } from "preline/preline";

window.HSStaticMethods.autoInit();
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-hs-select].--prevent-on-load-init').forEach((el) => new HSSelect(el));
});


Notify.init({
    fontFamily: 'Cairo',
    fontSize: '16px',
    useGoogleFont: true,
    width: '400px',
});

window.addEventListener('success-message', event => {
    Notify.success(event.detail[0]['message']);
});

window.addEventListener('error-message', event => {
    Notify.failure(event.detail[0]['message']);
});

window.addEventListener('warning-message', event => {
    Notify.warning(event.detail[0]['message']);
});

window.addEventListener('info-message', event => {
    Notify.info(event.detail[0]['message']);
});

Swiper.use([Navigation, Pagination, Autoplay]);


const swiper = new Swiper('.swiper-container', {
    // Optional parameters
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        type: 'bullets',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

const gallerySwiper = new Swiper('.gallery-swiper', {
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        type: 'bullets',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
