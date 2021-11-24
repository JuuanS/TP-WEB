<?php

class UserModel
{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getUserByEmail($email)
    {
        $query = $this->db->prepare('SELECT u.id as userID, u.user_name as userName, u.email, u.password, r.id as roleID, r.role_name as roleName FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = ?');
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    function getUserByUserName($userName)
    {
        $query = $this->db->prepare('SELECT u.id as userID, u.user_name as userName, u.email, u.password, r.id as roleID, r.role_name as roleName FROM users u JOIN roles r ON u.role_id = r.id WHERE u.user_name = ?');
        $query->execute([$userName]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    function getUsers($loggedUserID)
    {
        $query = $this->db->prepare('SELECT u.id as userID, u.user_name as userName, u.email, u.password, r.id as roleID, r.role_name as roleName, (CASE WHEN u.id = ? THEN true ELSE false END) as isLoggedUser FROM users u JOIN roles r ON u.role_id = r.id');
        $query->execute([$loggedUserID]);
        $users = $query->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    function getUserByID($userID)
    {
        $query = $this->db->prepare('SELECT u.id as userID, u.user_name as userName, u.email, u.password, r.id as roleID, r.role_name as roleName FROM users u JOIN roles r ON u.role_id = r.id WHERE u.id = ?');
        $query->execute([$userID]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    function createUser($userName, $email, $password)
    {
        $query = $this->db->prepare('INSERT INTO users (user_name, email, password, role_id) VALUES(?, ?, ?, (SELECT r.id FROM roles r WHERE r.role_name = ? ))');
        $query->execute([$userName, $email, $password, 'USER']);
        return $this->db->lastInsertId();
    }

    function updateUserPermissions($userID, $roleId)
    {
        $query = $this->db->prepare('UPDATE users SET role_id = ? WHERE id = ?');
        $query->execute([$roleId, $userID]);
    }

    function deleteUser($userID)
    {
        $query = $this->db->prepare('DELETE FROM users WHERE id = ?');
        $query->execute([$userID]);
    }
}
