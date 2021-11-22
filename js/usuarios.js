"use strict"

let app = new Vue({
    el: "#template-users-list",
    data: {
        title: 'Listado de Usuarios',
        users: [],
        error: null,
    }
});

function addEvents() {
    var checkExist = setInterval(function () {
        let buttons = document.querySelectorAll('button[id]');
        buttons.forEach(button => {
            button.addEventListener("click", (evento) => {
                handleActionSelected(evento);
            });
        });
        if (buttons.length > 0) {
            clearInterval(checkExist);
        }
    }, 100);
}

function getUsers() {
    app.users = [];
    fetch("api/usuarios")
        .then(response => response.json())
        .then(users => {
            app.users = users;
            addEvents();
        }).catch(error => console.log(error));
}

/**
 * 
 * @param e 
 */
function handleActionSelected(e) {
    e.preventDefault();
    const eventID = e.target.id;
    if (eventID && eventID.length > 0) {
        const action = eventID.split('_')[0];
        const userID = eventID.split('_')[1];
        switch (action) {
            case 'btn-add':
            case 'btn-remove': {
                updateUserPermission(userID);
                break;
            }
            case 'btn-delete': {
                deleteUser(userID);
                break;
            }
            default:
                break;
        }
    }
}

/**
 * 
 * @param userID 
 * @param adminPerm 
 */
function updateUserPermission(userID) {
    let url = 'api/usuarios/' + userID;
    fetch(url, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
    }).then(response => {
        if (response.ok) {
            getUsers();
        }
    }).catch(error => console.log(error));
}

/**
 * 
 * @param userID 
 */
function deleteUser(userID) {
    let url = 'api/usuarios/' + userID;
    fetch(url, {
        method: "DELETE"
    }).then(response => {
        if (response.ok) {
            getUsers();
        }
    }).catch(error => console.log(error));
}

getUsers();