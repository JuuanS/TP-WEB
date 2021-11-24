"use strict"

const API_URL = "api/peliculas";
let btnPreviousPage;
let btnNextPage;
let page = 1;
let collectionSize = 0;

let app = new Vue({
    el: "#template-movie-list",
    data: {
        movies: [],
        pageSize: 8,
        searchTitle: null,
        searchCategory: null,
        searchResponse: false,
    }
});

function addEvents() {
    setTimeout(() => {
        btnPreviousPage = document.querySelector('#btn-pag-previous');
        btnPreviousPage.addEventListener('click', goToPreviousPage)
        btnNextPage = document.querySelector("#btn-pag-next");
        btnNextPage.addEventListener('click', goToNextPage)
        document.querySelector('#search-movie-form').addEventListener('submit', searchByFilters);
    }, 250);
}

/**
 * 
 * @returns 
 */
function getMaxPage() {
    if (collectionSize !== 0) {
        return Math.ceil(collectionSize / app.pageSize);
    }
    return 1;
}

function getMovies() {
    app.searchResponse = false;

    let url = API_URL + '?page=' + page + '&pageSize=' + app.pageSize;
    if (app.searchTitle) {
        url += '&title=' + app.searchTitle;
        if (app.searchCategory) {
            url += '&category=' + app.searchCategory;
        }
    } else if (app.searchCategory) {
        url += '&category=' + app.searchCategory;
    }

    fetch(url)
        .then(response => response.json())
        .then(json => {
            app.movies = json?.movies;
            collectionSize = json?.collectionSize;
            app.searchResponse = true;
            addEvents();
            configPagination();
        }).catch(error => {
            app.searchResponse = true;
            console.log(error);
        });
};

function goToNextPage(e) {
    e.preventDefault();
    if (page < getMaxPage()) {
        page += 1;
        getMovies();
    }
}

function goToPreviousPage(e) {
    e.preventDefault();
    if (page > 1) {
        page -= 1;
        getMovies();
    }
}

function configPagination() {
    setTimeout(() => {
        document.querySelector("#current-page").innerHTML = page + ' de ' + getMaxPage();
        if (page === getMaxPage()) {
            btnNextPage.classList.add("disabled");
        } else {
            btnNextPage.classList.remove("disabled");
        }
        if (page === 1) {
            btnPreviousPage.classList.add("disabled");
        } else {
            btnPreviousPage.classList.remove("disabled");
        }
    }, 250);
}

function searchByFilters(e) {
    e.preventDefault();
    const title = document.querySelector("input[name=title]").value;
    const category = document.querySelector("select[name=category]").value;
    if (title.length > 0) {
        app.searchTitle = title;
    } else {
        app.searchTitle = null;
    }
    if (category.length > 0) {
        app.searchCategory = category;
    } else {
        app.searchCategory = null;
    }
    page = 1;
    getMovies();
}

getMovies();