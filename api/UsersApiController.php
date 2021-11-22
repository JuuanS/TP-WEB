<?php
require_once 'models/user.model.php';
require_once("./api/ApiController.php");
require_once("./api/JSONView.php");
require_once 'helpers/auth.helper.php';

class UsersApiController extends ApiController
{

    private $userModel;
    private $view;
    private $authHelper;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->view = new JSONView();
        $this->authHelper = new AuthHelper();
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
        $user = $this->getData();
        $userID = $this->userModel->createUser($user->userName, $user->email, $user->password);
        $newUser = $this->userModel->getUserByID($userID);
        if ($newUser) {
            $this->view->response($newUser, 200);
            $this->authHelper->login($user);
            header("Location: " . BASE_URL);
        } else {
            $this->view->response("Error al registar el usuario", 500);
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
