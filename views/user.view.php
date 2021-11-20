<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class UserView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showUsers($users, $roles)
    {
        $this->smarty->assign('title', 'Listado de Usuarios');
        $this->smarty->assign('users', $users);
        $this->smarty->assign('roles', $roles);
        $this->smarty->assign('error', '');
        $this->smarty->assign('userRole', $_SESSION ? $_SESSION["USER_ROLE"] : 'USER');
        $this->smarty->display('templates/user-list.tpl');
    }

    function showError($error)
    {
        $this->smarty->assign('error', $error);
    }
}
