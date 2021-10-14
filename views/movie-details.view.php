<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class MovieDetailsView {
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }
    
    function showMovieDetails($movie) {
        $this->smarty->assign('title', 'Detalle');
        $this->smarty->assign('movie', $movie);
        $this->smarty->display('templates/movie-details.tpl');
    }

}
