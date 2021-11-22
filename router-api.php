<?php
require_once 'libs/Router.php';
require_once("./api/UsersApiController.php");

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

$router = new Router();

//Users
$router->addRoute('usuarios', 'GET', 'UsersApiController', 'getUsers');
$router->addRoute('usuarios', 'POST', 'UsersApiController', 'registerUser');
$router->addRoute('usuarios/:ID', 'PUT', 'UsersApiController', 'updateUser');
$router->addRoute('usuarios/:ID', 'DELETE', 'UsersApiController', 'deleteUser');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 