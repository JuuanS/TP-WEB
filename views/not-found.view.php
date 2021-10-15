<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class NotFoundView {
    private $smarty; 

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showNotFound() {
        $this->smarty->display('templates/not-found.tpl');
    }
}