<?php

require_once 'models/user.model.php';
require_once 'models/role.model.php';
require_once 'views/user.view.php';
require_once 'views/register.view.php';
require_once 'helpers/auth.helper.php';

class UserController
{
    private $userModel;
    private $roleModel;
    private $userView;
    private $registerView;
    private $authHelper;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userView = new UserView();
        $this->roleModel = new RoleModel();
        $this->registerView = new RegisterView();
        $this->authHelper = new AuthHelper();
    }

    public function showUsers()
    {
        $this->authHelper->checkAdminPermission();
        $users = $this->userModel->getUsers();
        $roles = $this->roleModel->getRoles();
        $this->userView->showUsers($users, $roles);
    }

    public function showRegisterForm()
    {
        $this->registerView->showRegister();
    }

    public function registerUser()
    {
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($userName) || empty($email) || empty($password)) {
            // $this->registerView->showError('Campos requeridos faltantes.');
        }
        $hashedPassword = md5($password);
        $newUserID = $this->userModel->createUser($userName, $email, $hashedPassword);

        if (empty($newUserID)) {
            // $this->registerView->showError('Ocurrio un error con el registro, por favor intentelo mas tarde.');
        } else {
            $user = $this->userModel->getUserByID($newUserID);
            $this->authHelper->login($user);
            header("Location: " . BASE_URL . "peliculas");
        }
    }

    public function updateUserPermission($userID, $adminPermission)
    {
        $this->authHelper->checkAdminPermission();

        if (empty($userID)) {
            $this->user->showError('Ocurrio un error al actualizar el permiso, por favor intentelo mas tarde.');
        }

        $roleID = 1;
        if (!$adminPermission) {
            $roleID = 2;
        }

        $this->userModel->updateUserPermissions($userID, $roleID);
        $this->showUsers();
        header("Location: " . BASE_URL . "peliculas");
    }

    public function deleteUser($userID)
    {
        $this->authHelper->checkAdminPermission();

        if (empty($userID)) {
            // $this->userView->showError('Campos requeridos faltantes.');
        }
        $this->userModel->deleteUser($userID);
        $this->showUsers();
    }
};
