<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class MoviesView {
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
    
    function showMovies($movies, $categories) {
        $this->smarty->assign('title', 'Listado de Peliculas');
        $this->smarty->assign('movies', $movies);
        $this->smarty->assign('userRole', $_SESSION ? $_SESSION["USER_ROLE"] : 'USER');
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('templates/movies-list.tpl');
    }

}
