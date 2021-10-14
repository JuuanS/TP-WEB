<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class MovieFormView {
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showMovieForm($movie, $categories, $mode) {
        $fromTitle = $mode === 'create' ? 'Agregar Pelicula' : 'Editar Pelicula - ' . $movie->title;
        $this->smarty->assign('title', $fromTitle);
        $this->smarty->assign('mode', $mode);
        $this->smarty->assign('movie', $movie);        
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('templates/movie-form.tpl');
    }

}
