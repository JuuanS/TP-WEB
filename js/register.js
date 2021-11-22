"use strict"

const API_URL = "api/usuarios";
window.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();
    document.querySelector('#register-form').addEventListener('submit', registerUser);
});

let app = new Vue({
    el: "#template-register-form",
    data: {
        title: 'Registro de Usuarios',
        comments: [],
        error: null,
    }
});

function registerUser(e) {
    e.preventDefault();
    let data = {
        userName: document.querySelector("input[name=userName]").value,
        email: document.querySelector("input[name=email]").value,
        password: document.querySelector("input[name=password]").value
    };
    fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(response => response.json())
        .then(json => {
            if (json && json.errorMessage) {
                app.error = json.errorMessage;
            } else {
                window.location.href = window.location.href.replace('/registrar', '/peliculas');
            }
        }).catch(error => {
            console.log(error);
        });
}