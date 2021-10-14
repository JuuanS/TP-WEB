<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class MoviesView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showMovies($movies, $categories)
    {
        $this->smarty->assign('title', 'Listado de Peliculas');
        $this->smarty->assign('movies', $movies);
        $this->smarty->assign('userRole', $_SESSION ? $_SESSION["USER_ROLE"] : 'USER');
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('templates/movies-list.tpl');
    }

    function showMovieForm($movie, $categories, $mode)
    {
        $fromTitle = $mode === 'create' ? 'Agregar Pelicula' : 'Editar Pelicula - ' . $movie->title;
        $this->smarty->assign('title', $fromTitle);
        $this->smarty->assign('mode', $mode);
        $this->smarty->assign('movie', $movie);
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('templates/movie-form.tpl');
    }

    function showMovieDetails($movie)
    {
        $this->smarty->assign('title', 'Detalle');
        $this->smarty->assign('userRole', $_SESSION ? $_SESSION["USER_ROLE"] : 'USER');
        $this->smarty->assign('movie', $movie);
        $this->smarty->display('templates/movie-details.tpl');
    }
}
