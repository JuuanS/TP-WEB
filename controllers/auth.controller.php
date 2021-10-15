<?php
require_once 'models/user.model.php';
require_once 'views/auth.view.php';
require_once 'helpers/auth.helper.php';

class AuthController {
    private $model;
    private $view;
    private $authHelper;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
        $this->authHelper = new AuthHelper();
    }

    public function showLogin() {
        $this->view->showFormLogin();
    }

    public function login() {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {

            $email = $_POST['email'];
            $user = $this->model->getUser($email);
            $hashedPassword = md5($_POST['password']);

            if ($user && ($hashedPassword == $user->password)) {
                $this->authHelper->login($user);
                header("Location: " . BASE_URL);
            } else {
                $this->view->showFormLogin("Usuario o contraseña inválida");
            }
        }
    }

    public function logout() {
        $this->authHelper->logout();
    }
}