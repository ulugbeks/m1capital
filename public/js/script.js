// === DOM Elements ===
const circleBgButtons = document.querySelectorAll('.circleBg-btn');
const nav = document.querySelector('.nav');
const toTopButtons = document.querySelectorAll('#toTop');
const modal = document.querySelector('.product-modal');
const modalCloseBtn = document.querySelector('.product-modal__close');
const solutionLink = document.querySelector('#nav_solutions_link');
const solutionBlock = document.querySelector('#nav_solutions');
const aboutLink = document.querySelector('#nav_about_link');
const aboutBlock = document.querySelector('#nav_about');
const logoImg = document.querySelector('.nav__logo img');
let isModalOpened = false;
let isSubmenuOpened = false;
const page = window.location.pathname;
const isPhone = window.matchMedia('(max-width: 768px)').matches;
const relaxes = document.querySelectorAll('.rellax');
let scrollImgs = document.querySelectorAll('img.scroll');
const scrollConstVhs = 0.20;
const scrollConst = window.innerHeight * scrollConstVhs;


function initScrollImgs() {
    scrollImgs = document.querySelectorAll('img.scroll');
}

// === Rellax ===
relaxes.forEach(el => {
    new Rellax(el, {
        center: true,
    });
});

window.addEventListener('scroll', () => {
    let a = 0
    scrollImgs.forEach(img => {
        const imgBottom = img.getBoundingClientRect().bottom;
        const viewportHeight = window.innerHeight;

        if (imgBottom - viewportHeight <= -scrollConst) {
            img.classList.add('active');
        }
    });
});

// === Configuration & Helpers ===
const dragSwiper = (selector, args = {}) => {
    const defaultArgs = {
        direction: 'horizontal',
        slidesPerView: 'auto',
        spaceBetween: !isPhone ? 40 : 8,
        centeredSlidesBounds: true,
        resistanceRatio: 0,
        touchReleaseOnEdges: true,
        freeMode: {
            enabled: true,
            sticky: true,
            momentum: false,
            momentumBounce: true,
        },
        grabCursor: true,
    };
    const config = Object.assign({}, defaultArgs, args);
    return new Swiper(selector, config);
};

// === Smooth Scrolling (Lenis) ===
if (!isPhone) {
    const lenis = new Lenis({
        duration: 1.2,
        easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    });
    const raf = time => {
        lenis.raf(time);
        requestAnimationFrame(raf);
    };
    requestAnimationFrame(raf);
}

// === Get Started Button Hover Effects ===
circleBgButtons.forEach(circleBgButton => {
    circleBgButton.addEventListener('mouseenter', () => {
        setTimeout(() => circleBgButton.classList.add('_hover-wait'), 300);
    });
    circleBgButton.addEventListener('mouseleave', () => {
        setTimeout(() => circleBgButton.classList.remove('_hover-wait'), 200);
    });
})

// === Navigation Toggle ===
const toggleNav = ({ deltaY }) => {
    if (isModalOpened) return;

    if (!isPhone) {
        logoImg.src = '/assets/logo_black.svg';
    };
    if (isPhone) {
        document.querySelector('.nav__phone img').src = '/assets/logo_black.svg';
    }
    const scrollPos = window.scrollY + deltaY;

    if (scrollPos <= 60 && !isSubmenuOpened && page == '/') {
        logoImg.src = '/assets/logo_white.svg';
        document.querySelector('.nav__phone img').src = '/assets/logo_white.svg';
        nav.classList.remove('active', 'hidden');
    } else if (scrollPos < window.innerHeight * 0.5) {
        nav.classList.add('active');
        nav.classList.remove('hidden');
    } else if (deltaY > 0) {
        nav.classList.add('hidden');
    } else {
        nav.classList.add('active');
        nav.classList.remove('hidden');
    }
};

document.addEventListener('wheel', toggleNav);
document.addEventListener('touchmove', toggleNav);

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => toggleNav({ deltaY: 1 }), 200);
});

// === Scroll To Top ===
toTopButtons.forEach(button => {
    button.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

// === Products Slider ===
function initProductsSlider(products, selector) {
    const wrapper = document.querySelector(`${selector} .swiper-wrapper`);
    Object.entries(products).forEach(([key, product]) => {
        const slide = document.createElement('div');
        slide.className = 'product products__slide swiper-slide';
        slide.dataset.product = key;

        slide.innerHTML = `
        <div class="product__icon">
          <i class="product__icon-img fas fa-arrow-right"></i>
        </div>
        <div class="product__preview">
          <img src="/assets/products/${key}.png" class="product__img">
        </div>
        <div class="product__info">
          <div class="product__title">${product.title}</div>
          <div class="product__subtitle">${product.subtitle}</div>
        </div>
      `;

        slide.addEventListener('click', () => openProductModal(key));
        wrapper.appendChild(slide);
    });

    return dragSwiper(selector, {
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        pagination: { el: '.swiper-pagination', type: 'progressbar' },
    });
}

// === Product Modal ===
function openProductModal(key) {
    if (isModalOpened) return;
    isModalOpened = true;

    const product = products[key];
    modal.querySelector('.product-modal__title').textContent = product.title;
    modal.querySelector('.product-modal__subtitle').textContent = product.subtitle;
    modal.querySelector('.product-modal__text').innerHTML =
        product.description.replace(/\n/g, '<br/>') +
        '<br/><br/>' +
        `${product.manufacters_standart} standard manufacturer’s warranty.`;

    modal.querySelector('#modal_features').innerHTML =
        product.features.map(f => `<li>${f}</li>`).join('');
    modal.querySelector('#modal_applications').innerHTML =
        product.applications.map(a => `<li>${a}</li>`).join('');
    modal.querySelector('img').src = `/assets/products/${key}.png`;
    modal.classList.remove('hidden');
}

if (modalCloseBtn) {
    modalCloseBtn.addEventListener('click', () => {
        modal.classList.add('hide_anim');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('hide_anim');
            isModalOpened = false;
        }, 500);
    });
}

// === Submenu Handlers ===
const overlay = document.querySelector('.nav__overlay');
const body = document.body;

function setupSubmenu(link, block) {
    if (!link || !block) return;
    const open = () => {
        isSubmenuOpened = true;
        toggleNav({ deltaY: 0 });
        block.classList.add('active');
        overlay.classList.add('active');
        body.classList.add('overflow-hidden');
    };
    const close = () => {
        isSubmenuOpened = false;
        block.classList.remove('active');
        overlay.classList.remove('active');
        body.classList.remove('overflow-hidden');
        setTimeout(() => toggleNav({ deltaY: 0 }), 600);
    };
    link.addEventListener('mouseenter', open);
    link.addEventListener('mouseleave', e => {
        if (e.toElement && e.toElement.classList.contains('nav__submenu')) return;
        close();
    });
    block.addEventListener('mouseleave', close);
}

setupSubmenu(solutionLink, solutionBlock);
setupSubmenu(aboutLink, aboutBlock);

if (isPhone) {
    document.querySelector('#nav_open').onclick = () => {
        nav.classList.add('opened');
    }

    document.querySelector('#nav_close').onclick = () => {
        nav.classList.remove('opened');
    }
}