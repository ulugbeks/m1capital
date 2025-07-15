const helpTab_links = document.querySelectorAll('.help__link')
const helpTab_slides = document.querySelectorAll('.help__slide')
const helpTab_subtitle = document.querySelector('.help__subtitle')
const helpTab_text = document.querySelector('.help__text')
let helpTab_isWait = false;

function toggleHelpTab(tab, isTime = false) {
    if (helpTab_isWait) return;

    document.querySelector('.help__description').classList.add('disabled');
    setTimeout(() => {
        helpTab_subtitle.textContent = how_we_can_help[tab][0];
        helpTab_text.textContent = how_we_can_help[tab][1];
        document.querySelector('.help__description').classList.remove('disabled');
        document.querySelector('.help__description').classList.add('new');
    }, 150);
    setTimeout(() => {
        document.querySelector('.help__description').classList.remove('disabled');
        document.querySelector('.help__description').classList.remove('new');
    }, 400);

    const prevSlide = document.querySelector('.help__slide.active');
    const nextSlide = document.querySelector(`.help__slide[data-tab="${tab}"]`);

    helpTab_links.forEach(link => {
        link.classList.toggle('active', link.dataset.tab === tab);
        link.classList.toggle('animation', link.dataset.tab === tab && isTime);
    });

    if (prevSlide === nextSlide) return;
    nextSlide.style.zIndex = 3;
    nextSlide.classList.add('active');

    if (prevSlide) prevSlide.style.zIndex = 1;

    helpTab_isWait = true;

    setTimeout(() => {
        if (prevSlide) {
            prevSlide.classList.remove('active');
            prevSlide.style.zIndex = '';
        }
        nextSlide.style.zIndex = 2;
        helpTab_isWait = false;
    }, 550);
}

let interval = 0;

if (!isPhone) {
    helpTab_links.forEach(link => {
        link.addEventListener('click', () => {
            toggleHelpTab(link.dataset.tab);
            clearInterval(interval)
        })
    })
    interval = setInterval(() => {
        const currentActive = document.querySelector('.help__link.active');
        let nextTab = '';
        if (currentActive.nextElementSibling) {
            nextTab = currentActive.nextElementSibling.dataset.tab;
        } else {
            nextTab = helpTab_links[0].dataset.tab;
        }
        toggleHelpTab(nextTab, true);
        time = 0;
    }, 5000);
    toggleHelpTab('expertise', true)
}





const productsSlider = initProductsSlider(products, '.products-slider')


const partnersSlider = document.querySelector('.partners__slider .swiper-wrapper');

for (let i = 1; i <= partner_count; i++) {
    const partnerElement = document.createElement('div');
    partnerElement.className = 'partners__slide swiper-slide partner';
    partnerElement.innerHTML = `
        <img src="/assets/partners/${i}.png" class="partner__img">
        <div class="partner__logo-wrapper">
            <img src="/assets/partners/${i}.logo.png" class="partner__logo" alt="">
        </div>
    `;

    partnersSlider.appendChild(partnerElement);
}

const partners_swiper = dragSwiper('.partners__slider')