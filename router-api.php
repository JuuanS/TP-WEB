<?php
require_once 'libs/Router.php';

$router = new Router();

//Login

//Movies

//Categories

//Users
$router->addRoute('usuarios', 'GET', 'UserController', 'getUsers');
$router->addRoute('usuarios', 'POST', 'UserController', 'registerUser');
$router->addRoute('usuarios', 'PUT', 'UserController', 'updateUserPermissons');


$router->route($_GET["resources"], $_SERVER['REQUEST_METHOD']);