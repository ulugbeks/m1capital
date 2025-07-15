function initNews(news, imgPath) {
    const newsWrapper = document.querySelector('.news__wrapper');
    for (let id in news) {

        let newItem = document.createElement('div');
        newItem.classList.add('new');


        newItem.innerHTML = `
            <a href="/news/${id}">
                <div class="new__preview"><img src="${imgPath}${id}.png" alt="" class="new__img"></div>
                <p class="new__date">${news[id].date}</p>
                <p class="new__title">${news[id].title}</p>
                <button class="new__button">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </a>
        `;
        newsWrapper.appendChild(newItem);
    }
    return newsWrapper;
}

function initNew() {
    let url = window.location.pathname.split('/');
    let newId = url[url.length - 2];
    if (!news[newId]) {
        newId = url[url.length - 1]
        if (!news[newId]) {
            window.location.href = '/404.html';
        }
    }

    document.querySelector('#new_title').innerHTML = news[newId].title;
    document.querySelector('#new_date').innerHTML = news[newId].date;
    document.querySelector('#new_text').innerHTML = news[newId].text.replace(/\n/g, '<br>');
    document.querySelector('#new_img').src = '/data/news/' + newId + '.png';
}