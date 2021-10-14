<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class MovieDetailsView {
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
    
    function showMovieDetails($movie) {
        $this->console_log($_SESSION);

        $this->smarty->assign('title', 'Detalle');
        $this->smarty->assign('userRole', $_SESSION["USER_ROLE"]);
        $this->smarty->assign('movie', $movie);
        $this->smarty->display('templates/movie-details.tpl');
    }

}
