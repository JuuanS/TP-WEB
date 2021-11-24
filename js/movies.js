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
    },
    methods: {
        handleNextPage: function (event) {
            event.preventDefault();
            if (page < getMaxPage()) {
                page += 1;
                getMovies();
            }
        },
        handlePreviousPage: function (event) {
            event.preventDefault();
            if (page > 1) {
                page -= 1;
                getMovies();
            }
        },
        handleOnSearch: function (event) {
            event.preventDefault();
            searchByFilters();
        }
    }
});

function setButtonsReference() {
    setTimeout(() => {
        btnPreviousPage = document.querySelector('#btn-pag-previous');
        btnNextPage = document.querySelector("#btn-pag-next");
    }, 250);
}

function getMaxPage() {
    if (collectionSize !== 0) {
        return Math.ceil(collectionSize / app.pageSize);
    }
    return 1;
}

/**
 * 
 * @param referenceButtons false by default
 */
function getMovies(referenceButtons = false) {
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
            if (referenceButtons) {
                setButtonsReference();
            }
            configPagination();
        }).catch(error => {
            app.searchResponse = true;
            console.log(error);
        });
};

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

function searchByFilters() {
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

getMovies(true);