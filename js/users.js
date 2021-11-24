"use strict"

let app = new Vue({
    el: "#template-users-list",
    data: {
        title: 'Listado de Usuarios',
        users: [],
        error: null,
    },
    methods: {
        handleDeleteUser: function (id) {
            deleteUser(id);
        },
        handleUpdatePermissions: function (id) {
            updateUserPermission(id);
        }
    }
});

function getUsers() {
    fetch("api/usuarios")
        .then(response => response.json())
        .then(users => {
            app.users = users;
        }).catch(error => console.log(error));
}

/**
 * 
 * @param userID 
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