<?php

require_once 'models/movie.model.php';
require_once 'classes/ResponseMovies.php';
require_once("./api/JSONView.php");

class MoviesApiController
{

    private $movieModel;
    private $view;

    public function __construct()
    {
        $this->movieModel = new MovieModel();
        $this->view = new JSONView();
    }

    public function getMovies($params = [])
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $pageSize = isset($_GET['pageSize']) ? intval($_GET['pageSize']) : 8;
        $title = null;
        $category = null;

        if (isset($_GET['title'])) {
            $title = $_GET['title'];
        }
        if (isset($_GET['category'])) {
            $category = intval($_GET['category']);
        }
        $offset = ($page - 1) * $pageSize;
        $movies = $this->movieModel->getMovies($offset, $pageSize, $title, $category);
        $collectionSize = $this->movieModel->getMoviesCount($title, $category);
        $this->view->response(new ResponseMovies($movies, intval($collectionSize)), 200);
    }
}
