<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class UserView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showUsers()
    {
        $this->smarty->display('templates/user-list-csr.tpl');
    }

    function showError($error)
    {
        $this->smarty->assign('error', $error);
    }
}
