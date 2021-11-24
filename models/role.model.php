<?php

class RoleModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost:3307;' . 'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getRoles()
    {
        $query = $this->db->prepare('SELECT r.id AS roleID, r.role_name AS roleName FROM roles r');
        $query->execute();
        $roles = $query->fetchAll(PDO::FETCH_OBJ);
        return $roles;
    }

    function getRoleByID($roleId)
    {
        $query = $this->db->prepare('SELECT r.id AS roleID, r.role_name AS roleName FROM roles r WHERE r.id = ?');
        $query->execute([$roleId]);
        $role = $query->fetch(PDO::FETCH_OBJ);
        return $role;
    }
}
