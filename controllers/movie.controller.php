<?php

require_once 'models/movie.model.php';
require_once 'models/category.model.php';
require_once 'views/movie.view.php';
require_once 'helpers/auth.helper.php';

class MovieController
{
    private $movieModel;
    private $categoryModel;
    private $movieView;
    private $authHelper;

    public function __construct()
    {
        $this->movieModel = new MovieModel();
        $this->categoryModel = new CategoryModel();
        $this->movieView = new MoviesView();
        $this->authHelper = new AuthHelper();
    }

    function redirectToMovies($afterDelete)
    {
        if ($afterDelete) {
            header("Location: " . BASE_URL . "peliculas?m=1");
        } else {
            header("Location: " . BASE_URL . "peliculas");
        }
    }

    public function showMovies()
    {
        $categories = $this->categoryModel->getAllCategories();
        $this->movieView->showMovies($categories);
    }

    public function showMovieDetails($movieID)
    {
        $movie = $this->movieModel->getMovieByID($movieID);
        $this->movieView->showMovieDetails($movie);
    }

    public function showAddMovie()
    {
        $this->authHelper->checkAdminPermission();
        $categories = $this->categoryModel->getAllCategories();
        $mode = 'create';
        $this->movieView->showMovieForm(null, $categories, $mode);
    }

    public function showEditMovie($movieID)
    {
        $this->authHelper->checkAdminPermission();
        $movie = $this->movieModel->getMovieByID($movieID);
        $categories = $this->categoryModel->getAllCategories();
        $mode = 'edit';
        $this->movieView->showMovieForm($movie, $categories, $mode);
    }

    function addMovies()
    {
        $this->authHelper->checkAdminPermission();
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $categoryID = $_REQUEST['category'];

        $path_img = $this->uploadMovieCover();

        if (!empty($title) && !empty($description) && !empty($categoryID)) {
            $this->movieModel->insertMovie($title, $description, $categoryID, $path_img);
            $this->redirectToMovies(false);
        } else {
            $categories = $this->categoryModel->getAllCategories();
            $this->movieView->showMovieForm(null, $categories, 'create', 'Error Creando Pelicula');
        }
    }

    function deleteMovies($movieID)
    {
        $this->authHelper->checkAdminPermission();
        $this->movieModel->deleteMovie($movieID);
        $this->redirectToMovies(true);
    }

    function updateMovies($movieID)
    {
        $this->authHelper->checkAdminPermission();
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $categoryID = $_REQUEST['category'];

        $movie = $this->movieModel->getMovieByID($movieID);

        $path_img = $this->uploadMovieCover();

        if (empty($path_img)) {
            $path_img = $movie->imageUrl;
        }

        $this->movieModel->updateMovie($movieID, $title, $description, $categoryID, $path_img);
        $this->redirectToMovies(false);
    }

    function uploadMovieCover()
    {
        if (empty($_FILES)) {
            return null;
        }

        $path = 'assets/images';
        $tmp_path = $_FILES['movie-cover']['tmp_name'];
        $name = $_FILES['movie-cover']['name'];
        $type = $_FILES['movie-cover']['type'];
        $converted_name = uniqid() . '_' . preg_replace('/\s+/', '_', strtolower($name));

        if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png') {
            return null;
        }

        if (!move_uploaded_file($tmp_path, "$path/$converted_name")) {
            return null;
        }

        return "$path/$converted_name";
    }
}
