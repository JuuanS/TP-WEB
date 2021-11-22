<?php
require_once 'libs/Router.php';
require_once("./api/UsersApiController.php");
require_once("./api/CommentsApiController.php");

define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]) . '/');

$router = new Router();

//Users
$router->addRoute('usuarios', 'GET', 'UsersApiController', 'getUsers');
$router->addRoute('usuarios', 'POST', 'UsersApiController', 'registerUser');
$router->addRoute('usuarios/:ID', 'PUT', 'UsersApiController', 'updateUser');
$router->addRoute('usuarios/:ID', 'DELETE', 'UsersApiController', 'deleteUser');

//Comments
$router->addRoute('comentarios/:ID', 'GET', 'CommentsApiController', 'getComments');
$router->addRoute('comentarios', 'POST', 'CommentsApiController', 'addComment');
$router->addRoute('comentarios/:ID', 'DELETE', 'CommentsApiController', 'deleteComment');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
