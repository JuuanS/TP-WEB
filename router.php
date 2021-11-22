<?php
require_once 'controllers/movie.controller.php';
require_once 'controllers/not-found.controller.php';
require_once 'controllers/category.controller.php';
require_once 'controllers/auth.controller.php';
require_once 'controllers/user.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('LOGIN', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/login');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'peliculas';
}
$params = explode('/', $action);

switch ($params[0]) {
        // Login
    case 'login':
        $authController = new AuthController();
        $authController->showLogin();
        break;
    case 'verify':
        $authController = new AuthController();
        $authController->login();
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
        // Movies
    case 'peliculas':
        $movieController = new MovieController();
        $movieController->showMovies();
        break;
    case 'busqueda':
        $movieController = new MovieController();
        $movieController->showMoviesByFilter();
        break;
    case 'agregar-pelicula':
        $movieController = new MovieController();
        $movieController->showAddMovie();
        break;
    case 'editar-pelicula':
        $movieController = new MovieController();
        $movieController->showEditMovie($params[1]);
        break;
    case 'pelicula':
        $movieController = new MovieController();
        $movieController->showMovieDetails($params[1]);
        break;
    case 'insertar':
        $movieController = new MovieController();
        $movieController->addMovies();
        break;
    case 'borrar':
        $movieController = new MovieController();
        $movieController->deleteMovies($params[1]);
        break;
    case 'actualizar':
        $movieController = new MovieController();
        $movieController->updateMovies($params[1]);
        break;
        // Categories
    case 'categorias':
        $categoriesController = new CategoryController();
        $categoriesController->showCategories();
        break;
    case 'categoria':
        $categoriesController = new CategoryController();
        $categoriesController->showEditCategory($params[1]);
        break;
    case 'agregar-categoria':
        $categoriesController = new CategoryController();
        $categoriesController->showAddCategory();
        break;
    case 'insertar-categoria':
        $categoriesController = new CategoryController();
        $categoriesController->addCategory();
        break;
    case 'actualizar-categoria':
        $categoriesController = new CategoryController();
        $categoriesController->updateCategory($params[1]);
        break;
    case 'borrar-categoria':
        $categoriesController = new CategoryController();
        $categoriesController->deleteCategory($params[1]);
        break;
        //Usuarios
    case 'registrar':
        $usersController = new UserController();
        $usersController->showRegisterForm();
        break;
    case 'usuarios':
        $usersController = new UserController();
        $usersController->showUsers();
        break;
    default:
        $notFoundController = new NotFound();
        $notFoundController->showNotFound();
        break;
}
