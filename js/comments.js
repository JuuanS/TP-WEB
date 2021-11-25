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
    },
    methods: {
        handleAddComment: function (event) {
            event.preventDefault();
            app.showAddForm = true;
        },
        handleCancelComment: function (event) {
            event.preventDefault();
            app.showAddForm = false;
        },
        handleConfirmComment: function (event) {
            event.preventDefault();
            confirmAddComment();
        },
        handleSortVotes: function (event) {
            event.preventDefault();
            sortVotes();
        },
        handleSortDate: function (event) {
            event.preventDefault();
            sortDate();
        },
        handleSearchByVotes: function (event) {
            event.preventDefault();
            searchByVote();
        },
        handleDeleteComment: function (id) {
            deleteComment(id);
        }
    }
});

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
        }).catch(error => {
            app.searchResponse = true;
            console.log(error);
        });
};

function confirmAddComment() {
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

function sortVotes() {
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

function sortDate() {
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

function searchByVote() {
    const vote = document.querySelector("select[name=votes-search]").value;
    if (vote.length > 0) {
        app.searchVote = Number(vote);
    } else {
        app.searchVote = null;
    }
    getComments();
}

getComments();