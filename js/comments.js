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
    }
});

function addEvents() {
    var checkExist = setInterval(function () {
        let buttons = document.querySelectorAll('.btn-delete');
        buttons.forEach(button => {
            button.addEventListener("click", (evento) => {
                handleDeleteComment(evento);
            });
        });
        if (buttons.length > 0) {
            clearInterval(checkExist);
        }
    }, 100);
}

function handleDeleteComment(e) {
    e.preventDefault();
    const eventID = e.target.id;
    if (eventID && eventID.length > 0) {
        const commentID = eventID.split('_')[1];
        deleteComment(commentID);
    }
}

function getComments() {
    app.comments = [];
    const url = API_URL + '/' + movieID
    fetch(url)
        .then(response => response.json())
        .then(comments => {
            app.comments = comments;
            document.querySelector('#show-add-comment').addEventListener('click', showAddComment);
            addEvents();
        }).catch(error => console.log(error));
};

function showAddComment(e) {
    e.preventDefault();
    app.showAddForm = true;
    setTimeout(() => {
        document.querySelector('#hide-add-comment').addEventListener('click', hideAddComment);
        document.querySelector('#form-add-comment').addEventListener('submit', confirmAddComment);
    }, 200);
}

function hideAddComment(e) {
    e.preventDefault();
    app.showAddForm = false;
}

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

getComments();