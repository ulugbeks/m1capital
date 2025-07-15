function initNumberGrid(wrapper, data, imgPath = '') {

    data.forEach((item, idx) => {
        let img = item?.img;
        if (!img) {
            console.log(imgPath);

            img = imgPath + (idx + 1).toString() + '.png';
        }
        const row = document.createElement('div');
        row.className = 'number-grid__row';
        row.innerHTML = `
            <div class="number-grid__preview">
                <img src="${img}" alt="" class="number-grid__img scroll">
            </div>
            <div class="number-grid__info">
                <span class="number-grid__num">${(idx + 1).toString().padStart(2, '0')}</span>
                <div class="number-grid__description section-description">
                    <p class="section-subtitle">${item.subtitle}</p>
                    <p class="section-text">${item.text}</p>
                </div>
            </div>
        `;
        wrapper.appendChild(row);
    });
}

function toggleQuestion(e) {
    const otherQuestions = e.target.closest('.questions-grid').querySelectorAll('.question');
    const question = e.target.closest('.question');
    question.classList.toggle('opened')
    if (question.classList.contains('opened')) {
        otherQuestions.forEach(q => {
            if (q !== question) {
                q.classList.remove('opened');
            }
        });
    }
    setTimeout(() => {
        question.querySelector('i').classList.toggle('fa-minus')
        question.querySelector('i').classList.toggle('fa-plus')
    }, 150);
}

function initQuestionsGrid(wrapper, data) {
    data.forEach((item, idx) => {
        const row = document.createElement('div');
        row.className = 'question';
        row.onclick = toggleQuestion;
        row.innerHTML = `
            <div class="question__content">
                <span class="question__number">${(idx + 1).toString().padStart(2, '0')}</span>
                <span class="question__title">${item.title}</span>
                <i class="fas fa-plus"></i>
            </div>
            <div class="question__description section-description">
                <p class="section-text">
                    ${item.answer}
                </p>
            </div>
    `;
        wrapper.appendChild(row);
    });
}
function initPersons(teamElement, data, basePath) {
    const categoriesContainer = teamElement.querySelector('.team__categories');
    const wrapperEl = teamElement.querySelector('#persons_wrapper');
    const swiperContainer = teamElement.querySelector('.persons-slider');

    const swiper = dragSwiper(swiperContainer)

    function renderSlides(filteredData) {
        const currentSlides = Array.from(swiper.slides);

        currentSlides.forEach(slide => {
            slide.classList.add('_hidden');
        });

        setTimeout(() => {
            swiper.removeAllSlides();

            const slides = filteredData.map(person => {
                const imgSrc = `${basePath}${person.category}/${person.name}.png`;
                return `
                <div class="swiper-slide person _hidden" data-category="${person.category}">
                    <img src="${imgSrc}" alt="${person.name}" class="person__img">
                    <div class="person__info">
                        <h3 class="person__name">${person.name}</h3>
                        <p class="person__post">${person.post}</p>
                    </div>
                </div>`;
            });

            swiper.appendSlide(slides);
            swiper.update();

            setTimeout(() => {
                const newSlides = Array.from(swiper.slides);

                newSlides.forEach(slide => {
                    slide.classList.remove('_hidden');
                });
            }, 350);
        }, 350);
    }

    categoriesContainer.addEventListener('click', e => {
        if (!e.target.classList.contains('team__category')) return;
        categoriesContainer.querySelectorAll('.team__category')
            .forEach(btn => btn.classList.remove('team__category_active'));
        e.target.classList.add('team__category_active');

        const category = e.target.dataset.category;
        const filtered = category
            ? data.filter(person => person.category === category)
            : data;
        renderSlides(filtered);
    });

    const firstBtn = categoriesContainer.querySelector('.team__category');
    if (firstBtn) {
        firstBtn.classList.add('team__category_active');
        const initCategory = firstBtn.dataset.category;
        renderSlides(data.filter(p => p.category === initCategory));
    } else {
        renderSlides(data);
    }

    return swiper;
}


function initPartnersGrid() {
    const partnersCategories = document.querySelector('[data-type="partnersGrid_category"]').querySelectorAll('button');
    const partnerImgs = document.querySelector('[data-type="partnersGrid_imgs"]').querySelectorAll('img');
    const description = document.querySelector('.partners__description');
    partnersCategories.forEach(el => {
        el.addEventListener('click', () => {
            partnersCategories.forEach(el => el.classList.remove('active'));
            partnerImgs.forEach(el => el.classList.remove('active'));
            document.querySelectorAll(`[data-category="${el.dataset.category}"]`).forEach(el => el.classList.add('active'));
            description.classList.add('hidden');
            setTimeout(() => {
                description.querySelector('.section-subtitle').innerHTML = aboutPartners[el.dataset.category][0];
                description.querySelector('.section-text').innerHTML = aboutPartners[el.dataset.category][1];
                setTimeout(() => {
                    description.classList.remove('hidden');
                }, 310);
            }, 310);
        })
    })
    partnersCategories[0].click();
}