<?php

require_once 'models/movie.model.php';
require_once 'models/category.model.php';
require_once 'views/movie.view.php';
require_once 'views/movie-form.view.php';
require_once 'views/movie-details.view.php';
require_once 'helpers/auth.helper.php';

class MovieController {
    private $movieModel;
    private $categoryModel;

    private $view;
    private $viewDetails;
    private $viewForm;

    private $authHelper;

    public function __construct() {
        $this->movieModel = new MoviesModel();
        $this->categoryModel = new CategoriesModel();
        $this->view = new MoviesView();
        $this->viewDetails = new MovieDetailsView();
        $this->viewForm = new MovieFormView();
        $this->authHelper = new AuthHelper();
    }

    function redirectToMovies() {
        header("Location: " . BASE_URL . "peliculas");
    }

    public function showMovies() {
        $movies = $this->movieModel->getAllMovies();
        $categories = $this->categoryModel->getAllCategories();
        $this->view->showMovies($movies, $categories);
    }

    // public function showMoviesByFilter() {
    //     $title = $_REQUEST['title'];
    //     $category = $_REQUEST['category'];

    //     $movies = $this->movieModel->getMoviesByFilter($title, $category !== 'null' ? $category : null);
    //     $categories = $this->categoryModel->getAllCategories();

    //     $this->view->showMovies($movies, $categories);
    // }

    public function showMovieDetails($movieID) {
        $movie = $this->movieModel->getMovieByID($movieID);
        $this->viewDetails->showMovieDetails($movie);
    }

    public function showAddMovie() {
        $categories = $this->categoryModel->getAllCategories();
        $mode = 'create';
        $this->viewForm->showMovieForm(null, $categories, $mode);
    }

    public function showEditMovie($movieID) {
        $movie = $this->movieModel->getMovieByID($movieID);
        $categories = $this->categoryModel->getAllCategories();
        $mode = 'edit';
        $this->viewForm->showMovieForm($movie, $categories, $mode);
    }

    function addMovies() {
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $categoryID = $_REQUEST['category'];

        $this->movieModel->insertMovie($title, $description, $categoryID);
        
        $this->redirectToMovies();
    }

    function deleteMovies($movieID) {
        $this->movieModel->deleteMovie($movieID);

        $this->redirectToMovies();
    }

    function updateMovies($movieID){
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $categoryID = $_REQUEST['category'];

        $this->movieModel->updateMovie($movieID, $title, $description, $categoryID);
        
        $this->redirectToMovies();
    }
}
