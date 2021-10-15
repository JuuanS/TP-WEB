<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost:3307;'.'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getUser($email) {
        $query = $this->db->prepare('SELECT u.id as userID, u.user_name as userName, u.email, u.password, r.id as roleID, r.role_name as roleName FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = ?');
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

}