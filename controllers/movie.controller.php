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

    function redirectToMovies()
    {
        header("Location: " . BASE_URL . "peliculas");
    }

    public function showMovies()
    {
        $movies = $this->movieModel->getAllMovies();
        $categories = $this->categoryModel->getAllCategories();
        $this->movieView->showMovies($movies, $categories);
    }

    public function showMoviesByFilter()
    {
        $title = $_REQUEST['title'];
        $category = $_REQUEST['category'];
        $movies = $this->movieModel->getMoviesByFilter($title, $category);
        $categories = $this->categoryModel->getAllCategories();
        $this->movieView->showMovies($movies, $categories);
    }

    public function showMovieDetails($movieID)
    {
        $movie = $this->movieModel->getMovieByID($movieID);
        $this->movieView->showMovieDetails($movie);
    }

    public function showAddMovie()
    {
        $categories = $this->categoryModel->getAllCategories();
        $mode = 'create';
        $this->movieView->showMovieForm(null, $categories, $mode);
    }

    public function showEditMovie($movieID)
    {
        $movie = $this->movieModel->getMovieByID($movieID);
        $categories = $this->categoryModel->getAllCategories();
        $mode = 'edit';
        $this->movieView->showMovieForm($movie, $categories, $mode);
    }

    function addMovies()
    {
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $categoryID = $_REQUEST['category'];

        if (!empty($title) && !empty($description) && !empty($categoryID)) {
            $this->movieModel->insertMovie($title, $description, $categoryID);
            $this->redirectToMovies();
        } else {
            //MOSTRAR ERROR
        }
    }

    function deleteMovies($movieID)
    {
        $this->movieModel->deleteMovie($movieID);
        $this->redirectToMovies();
    }

    function updateMovies($movieID)
    {
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $categoryID = $_REQUEST['category'];
        $this->movieModel->updateMovie($movieID, $title, $description, $categoryID);
        $this->redirectToMovies();
    }
}
