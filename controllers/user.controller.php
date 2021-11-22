<?php

require_once 'models/user.model.php';
require_once 'views/user.view.php';
require_once 'views/register.view.php';
require_once 'helpers/auth.helper.php';

class UserController
{
    private $userModel;
    private $userView;
    private $registerView;
    private $authHelper;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userView = new UserView();
        $this->registerView = new RegisterView();
        $this->authHelper = new AuthHelper();
    }

    public function showUsers()
    {
        $this->authHelper->checkAdminPermission();
        $this->userView->showUsers();
    }

    public function showRegisterForm()
    {
        $this->registerView->showRegister();
    }
};
