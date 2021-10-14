<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class MovieFormView {
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
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
