const findSolution_links = document.querySelectorAll('.help__link')
const findSolution_slides = document.querySelectorAll('.help__slide')
const findSolution_subtitle = document.querySelector('.help__subtitle')
const findSolution_text = document.querySelector('.help__text')
let findSolution_isWait = false;

function togglefindSolution(tab, isTime = false) {
    if (findSolution_isWait) return;

    document.querySelector('.help__description').classList.add('disabled');
    setTimeout(() => {
        findSolution_subtitle.textContent = how_find_best_solution[tab][0];
        findSolution_text.textContent = how_find_best_solution[tab][1];
        document.querySelector('.help__description').classList.remove('disabled');
        document.querySelector('.help__description').classList.add('new');
    }, 150);
    setTimeout(() => {
        document.querySelector('.help__description').classList.remove('disabled');
        document.querySelector('.help__description').classList.remove('new');
    }, 400);

    const prevSlide = document.querySelector('.help__slide.active');
    const nextSlide = document.querySelector(`.help__slide[data-tab="${tab}"]`);

    findSolution_links.forEach(link => {
        link.classList.toggle('active', link.dataset.tab === tab);
        link.classList.toggle('animation', link.dataset.tab === tab && isTime);
    });

    if (prevSlide === nextSlide) return;
    nextSlide.style.zIndex = 3;
    nextSlide.classList.add('active');

    if (prevSlide) prevSlide.style.zIndex = 1;

    findSolution_isWait = true;

    setTimeout(() => {
        if (prevSlide) {
            prevSlide.classList.remove('active');
            prevSlide.style.zIndex = '';
        }
        nextSlide.style.zIndex = 2;
        findSolution_isWait = false;
    }, 550);
}

let interval = 0;

if (!isPhone) {
    findSolution_links.forEach(link => {
        link.addEventListener('click', () => {
            togglefindSolution(link.dataset.tab);
            clearInterval(interval)
        })
    })
    interval = setInterval(() => {
        const currentActive = document.querySelector('.help__link.active');
        let nextTab = '';
        if (currentActive.nextElementSibling) {
            nextTab = currentActive.nextElementSibling.dataset.tab;
        } else {
            nextTab = findSolution_links[0].dataset.tab;
        }
        togglefindSolution(nextTab, true);
        time = 0;
    }, 5000);
    togglefindSolution('listen', true)
}