<?php

require_once 'models/user.model.php';
require_once 'classes/ApiError.php';
require_once("./api/JSONView.php");
require_once 'helpers/auth.helper.php';
require_once 'helpers/api.helper.php';

class UsersApiController
{

    private $userModel;
    private $view;
    private $authHelper;
    private $apiHelper;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->view = new JSONView();
        $this->authHelper = new AuthHelper();
        $this->apiHelper = new ApiHelper();
    }

    public function getUsers($params = null)
    {
        $loggedUserID = $this->authHelper->getLoggedUserID();
        $users = $this->userModel->getUsers($loggedUserID);
        $this->view->response($users, 200);
    }

    public function deleteUser($params = [])
    {
        $userID = $params[':ID'];
        $user = $this->userModel->getUserByID($userID);
        if ($user) {
            $this->userModel->deleteUser($userID);
            $this->view->response("Usuario eliminado con exito", 201);
        } else {
            $this->view->response("No se encontro el usuario con id=$userID", 404);
        }
    }

    public function registerUser($params = [])
    {
        $body = $this->apiHelper->getData();
        $email = $body->email;
        $userName = $body->userName;
        $password = $body->password;

        $existingEmail = $this->userModel->getUserByEmail($email);
        $existingUserName = $this->userModel->getUserByUserName($userName);

        if ($existingUserName) {
            $this->view->response(new ApiError("El nombre de usuario ingresado ya se encuentra registrado"), 403);
        } else if ($existingEmail) {
            $this->view->response(new ApiError("El email ingresado ya se encuentra registrado"), 403);
        } else {
            $hashedPassword = md5($password);
            $userID = $this->userModel->createUser($userName, $email, $hashedPassword);
            $newUser = $this->userModel->getUserByID($userID);
            if ($newUser) {
                $this->view->response($newUser, 200);
                $this->authHelper->login($newUser);
            } else {
                $this->view->response("Error al registar el usuario", 500);
            }
        }
    }

    public function updateUser($params = [])
    {
        $userID = $params[':ID'];
        $user = $this->userModel->getUserByID($userID);
        if ($user) {
            $roleID = 1;
            if ($user->roleID == 1) {
                $roleID = 2;
            }
            $this->userModel->updateUserPermissions($userID, $roleID);
            $this->view->response("Permiso de usuario actualizado con exito", 200);
        } else {
            $this->view->response("No se encontro el usuario con id=$userID", 404);
        }
    }
}
