"use strict"

const movieID = Number(document.querySelector("input[name=movie-id]").value);
const API_URL = "api/comentarios";

let app = new Vue({
    el: "#template-comments",
    data: {
        title: 'Listado de Usuarios',
        comments: [],
        error: null,
        showAddForm: false,
        movieID: null,
        orderDate: null, // null - 'asc' - 'desc'
        orderVotes: null, // null - 'asc' - 'desc'
        searchVote: null,
        searchResponse: false,
    }
});

function addEvents() {
    var checkExist = setInterval(function () {
        let buttons = document.querySelectorAll('.btn-delete');
        buttons.forEach(button => {
            button.addEventListener("click", handleDeleteComment);
        });
        if (buttons.length > 0) {
            clearInterval(checkExist);
        }
    }, 100);
}

/**
 * 
 * @param e
 */
function handleDeleteComment(e) {
    e.preventDefault();
    const eventID = e.target.id;
    if (eventID && eventID.length > 0) {
        const commentID = eventID.split('_')[1];
        deleteComment(commentID);
    }
}

function getComments() {
    app.searchResponse = false;
    let url = API_URL + '/' + movieID;
    if (app.searchVote) {
        url += '?searchVote=' + app.searchVote;
        if (app.orderDate) {
            url += '&sortDate=' + app.orderDate;
            if (app.orderVotes) {
                url += '&sortVote=' + app.orderVotes;
            }
        } else if (app.orderVotes) {
            url += '&sortVote=' + app.orderVotes;
        }
    } else if (app.orderDate) {
        url += '?sortDate=' + app.orderDate;
        if (app.orderVotes) {
            url += '&sortVote=' + app.orderVotes;
        }
    } else if (app.orderVotes) {
        url += '?sortVote=' + app.orderVotes;
    }

    fetch(url)
        .then(response => response.json())
        .then(comments => {
            app.comments = comments;
            app.searchResponse = true;
            document.querySelector('#show-add-comment').addEventListener('click', showAddComment);
            document.querySelector('#sort-votes').addEventListener('click', sortVotes);
            document.querySelector('#sort-date').addEventListener('click', sortDate);
            document.querySelector('#search-by-vote').addEventListener('click', searchByVote);
            addEvents();
        }).catch(error => {
            console.log(error);
            app.searchResponse = true;
        });
};

/**
 * 
 * @param e
 */
function showAddComment(e) {
    e.preventDefault();
    app.showAddForm = true;
    setTimeout(() => {
        document.querySelector('#hide-add-comment').addEventListener('click', hideAddComment);
        document.querySelector('#form-add-comment').addEventListener('submit', confirmAddComment);
    }, 200);
}

/**
 * 
 * @param e
 */
function hideAddComment(e) {
    e.preventDefault();
    app.showAddForm = false;
}

/**
 * 
 * @param e
 */
function confirmAddComment(e) {
    e.preventDefault();
    let data = {
        comment: document.querySelector("textarea[name=comment]").value,
        vote: Number(document.querySelector("select[name=vote]").value),
        movieID,
    }
    fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(response => {
        if (response.ok) {
            getComments();
            app.showAddForm = false;
        }
    }).catch(error => console.log(error));
}

/**
 * 
 * @param commentID
 */
function deleteComment(commentID) {
    const url = API_URL + '/' + commentID
    fetch(url, {
        method: 'DELETE'
    }).then(response => {
        if (response.ok) {
            getComments();
        }
    }).catch(error => console.log(error));
}

function sortVotes(e) {
    e.preventDefault();
    if (!app.orderVotes) {
        app.orderVotes = 'desc';
    } else {
        if (app.orderVotes === 'desc') {
            app.orderVotes = 'asc'
        } else {
            app.orderVotes = null;
        }
    }
    getComments();
}

/**
 * 
 * @param e 
 */
function sortDate(e) {
    e.preventDefault();
    if (!app.orderDate) {
        app.orderDate = 'desc';
    } else {
        if (app.orderDate === 'desc') {
            app.orderDate = 'asc'
        } else {
            app.orderDate = null;
        }
    }
    getComments();
}

/**
 * 
 * @param e 
 */
function searchByVote(e) {
    e.preventDefault();
    const vote = document.querySelector("select[name=votes-search]").value;
    if (vote.length > 0) {
        app.searchVote = Number(vote);
    } else {
        app.searchVote = null;
    }
    getComments();
}

getComments();