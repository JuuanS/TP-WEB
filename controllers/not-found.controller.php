<?php
require_once 'views/not-found.view.php';

class NotFound {
    private $view;

    public function __construct() {
        $this->view = new NotFoundView();
    }

    public function showNotFound() {
        $this->view->showNotFound();
    }
}