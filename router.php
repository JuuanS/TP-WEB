<?php
require_once 'controllers/movie.controller.php';
require_once 'controllers/not-found.controller.php';
require_once 'controllers/category.controller.php';
require_once 'controllers/auth.controller.php';
require_once 'controllers/user.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('LOGIN', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/login');

$authController = new AuthController();
$movieController = new MovieController();;
$categoriesController = new CategoryController();
$usersController = new UserController();
$notFoundController  = new NotFound();

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'peliculas';
}
$params = explode('/', $action);

switch ($params[0]) {
        // ->**************** Login ****************<-
    case 'login':
        $authController->showLogin();
        break;
    case 'verify':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'logout':
        $authController->logout();
        break;
        // ->**************** Movies ****************<-
    case 'peliculas':
        $movieController->showMovies();
        break;
    case 'agregar-pelicula':
        $movieController->showAddMovie();
        break;
    case 'editar-pelicula':
        $movieController->showEditMovie($params[1]);
        break;
    case 'pelicula':
        $movieController->showMovieDetails($params[1]);
        break;
    case 'insertar':
        $movieController->addMovies();
        break;
    case 'borrar':
        $movieController->deleteMovies($params[1]);
        break;
    case 'actualizar':
        $movieController->updateMovies($params[1]);
        break;
        // ->**************** Categories ****************<-
    case 'categorias':
        $categoriesController->showCategories();
        break;
    case 'categoria':
        $categoriesController->showEditCategory($params[1]);
        break;
    case 'agregar-categoria':
        $categoriesController->showAddCategory();
        break;
    case 'insertar-categoria':
        $categoriesController->addCategory();
        break;
    case 'actualizar-categoria':
        $categoriesController->updateCategory($params[1]);
        break;
    case 'borrar-categoria':
        $categoriesController->deleteCategory($params[1]);
        break;
        // ->**************** Usuarios ****************<-
    case 'registrar':
        $usersController->showRegisterForm();
        break;
    case 'usuarios':
        $usersController->showUsers();
        break;
    default:
        $notFoundController->showNotFound();
        break;
}
