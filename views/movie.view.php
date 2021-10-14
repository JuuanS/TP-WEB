<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class MoviesView {
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }
    
    function showMovies($movies, $categories) {
        $this->smarty->assign('title', 'Listado de Peliculas');
        $this->smarty->assign('movies', $movies);
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('templates/movies-list.html');
    }

}
