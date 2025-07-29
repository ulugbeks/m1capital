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

// Определяем, находимся ли мы на главной странице
const isHomePage = page === '/' || page === '/en' || page === '/lv' || page === '/en/' || page === '/lv/';

// Определяем, находимся ли мы на странице about
const isAboutPage = page.includes('/about');

// Объединяем проверку для страниц с особым поведением навигации
const isSpecialNavPage = isHomePage || isAboutPage;

// Отладочная информация
console.log('Navigation initialized:', {
    pathname: page,
    isHomePage: isHomePage,
    isAboutPage: isAboutPage,
    isSpecialNavPage: isSpecialNavPage
});

function initScrollImgs() {
    scrollImgs = document.querySelectorAll('img.scroll');
}

// === Rellax - проверяем существование библиотеки ===
if (typeof Rellax !== 'undefined' && relaxes.length > 0) {
    relaxes.forEach(el => {
        new Rellax(el, {
            center: true,
        });
    });
}

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
    // Проверяем существование Swiper
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper is not loaded');
        return null;
    }
    
    const element = document.querySelector(selector);
    if (!element) return null;
    
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
if (!isPhone && typeof Lenis !== 'undefined') {
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
const toggleNav = () => {
    if (isModalOpened) return;

    const scrollPos = window.scrollY;
    const phoneLogo = document.querySelector('.nav__phone img');

    // Логика для главной страницы и страницы about
    if (isSpecialNavPage) {
        // Если находимся в самом верху страницы (меньше 60px) и на специальной странице
        if (scrollPos <= 60 && !isSubmenuOpened) {
            if (logoImg) logoImg.src = '/assets/m1-logo-light.svg';
            if (phoneLogo) phoneLogo.src = '/assets/m1-logo-light.svg';
            nav.classList.remove('active', 'hidden');
        } else {
            // При любом скролле больше 60px добавляем active класс
            if (logoImg) logoImg.src = '/assets/m1-logo-black.svg';
            if (phoneLogo) phoneLogo.src = '/assets/m1-logo-black.svg';
            nav.classList.add('active');
            nav.classList.remove('hidden');
        }
    } else {
        // Для всех остальных страниц - всегда active
        if (logoImg) logoImg.src = '/assets/m1-logo-black.svg';
        if (phoneLogo) phoneLogo.src = '/assets/m1-logo-black.svg';
        nav.classList.add('active');
        nav.classList.remove('hidden');
    }
};

// Отдельная функция для скрытия/показа навигации при скролле
let lastScrollTop = 0;
const handleNavVisibility = () => {
    const scrollTop = window.scrollY;
    
    if (scrollTop > window.innerHeight * 0.5) {
        if (scrollTop > lastScrollTop) {
            // Скролл вниз
            nav.classList.add('hidden');
        } else {
            // Скролл вверх
            nav.classList.remove('hidden');
        }
    }
    
    lastScrollTop = scrollTop;
};

// Обработчики событий
document.addEventListener('scroll', () => {
    toggleNav();
    handleNavVisibility();
});

// Проверка начального состояния
document.addEventListener('DOMContentLoaded', () => {
    const phoneLogo = document.querySelector('.nav__phone img');
    
    if (isSpecialNavPage) {
        // Для главной страницы и страницы about проверяем скролл
        if (window.scrollY <= 60) {
            if (logoImg) logoImg.src = '/assets/m1-logo-light.svg';
            if (phoneLogo) phoneLogo.src = '/assets/m1-logo-light.svg';
            nav.classList.remove('active', 'hidden');
        } else {
            toggleNav();
        }
    } else {
        // Для всех остальных страниц сразу делаем навигацию активной
        if (logoImg) logoImg.src = '/assets/m1-logo-black.svg';
        if (phoneLogo) phoneLogo.src = '/assets/m1-logo-black.svg';
        nav.classList.add('active');
    }
});

// === Scroll To Top ===
toTopButtons.forEach(button => {
    button.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

// === Products Slider ===
function initProductsSlider(products, selector) {
    // Проверяем существование переменной products
    if (typeof products === 'undefined') {
        console.warn('Products variable is not defined');
        return;
    }
    
    const wrapper = document.querySelector(`${selector} .swiper-wrapper`);
    if (!wrapper) return;
    
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
    // Проверяем существование products
    if (typeof products === 'undefined') {
        console.warn('Products variable is not defined');
        return;
    }
    
    if (isModalOpened || !modal) return;
    isModalOpened = true;

    const product = products[key];
    if (!product) return;
    
    const titleEl = modal.querySelector('.product-modal__title');
    const subtitleEl = modal.querySelector('.product-modal__subtitle');
    const textEl = modal.querySelector('.product-modal__text');
    const featuresEl = modal.querySelector('#modal_features');
    const applicationsEl = modal.querySelector('#modal_applications');
    const imgEl = modal.querySelector('img');
    
    if (titleEl) titleEl.textContent = product.title;
    if (subtitleEl) subtitleEl.textContent = product.subtitle;
    if (textEl) {
        textEl.innerHTML =
            product.description.replace(/\n/g, '<br/>') +
            '<br/><br/>' +
            `${product.manufacters_standart} standard manufacturer's warranty.`;
    }
    if (featuresEl) {
        featuresEl.innerHTML = product.features.map(f => `<li>${f}</li>`).join('');
    }
    if (applicationsEl) {
        applicationsEl.innerHTML = product.applications.map(a => `<li>${a}</li>`).join('');
    }
    if (imgEl) {
        imgEl.src = `/assets/products/${key}.png`;
    }
    
    modal.classList.remove('hidden');
}

if (modalCloseBtn && modal) {
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
        toggleNav();
        block.classList.add('active');
        if (overlay) overlay.classList.add('active');
        body.classList.add('overflow-hidden');
    };
    const close = () => {
        isSubmenuOpened = false;
        block.classList.remove('active');
        if (overlay) overlay.classList.remove('active');
        body.classList.remove('overflow-hidden');
        setTimeout(() => toggleNav(), 600);
    };
    link.addEventListener('mouseenter', open);
    link.addEventListener('mouseleave', e => {
        const relatedTarget = e.relatedTarget || e.toElement;
        if (relatedTarget && relatedTarget.classList.contains('nav__submenu')) return;
        close();
    });
    block.addEventListener('mouseleave', close);
}

setupSubmenu(solutionLink, solutionBlock);
setupSubmenu(aboutLink, aboutBlock);

if (isPhone) {
    const navOpen = document.querySelector('#nav_open');
    const navClose = document.querySelector('#nav_close');
    
    if (navOpen) {
        navOpen.onclick = () => {
            nav.classList.add('opened');
        }
    }
    
    if (navClose) {
        navClose.onclick = () => {
            nav.classList.remove('opened');
        }
    }
}