<?php

class AuthHelper {
    function __construct() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function login($user) {
        $_SESSION['USER_ID'] = $user->userID;
        $_SESSION['USER_EMAIL'] = $user->email;
        $_SESSION['USER_ROLE'] = $user->roleName;
    }

    public function checkLoggedIn() {
        if (empty($_SESSION['USER_ID'])) {
            header("Location: " . LOGIN);
            die();
        }
    }

    function logout() {
        session_destroy();
        header("Location: " . BASE_URL . 'login');
    } 
}