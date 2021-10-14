<?php

class CategoriesModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost:3307;'.'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getAllCategories() {
        $query = $this->db->prepare('SELECT c.id as categoryID, c.category_name as categoryName FROM categories c');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    function getCategoryByID($categoryID) {    
        $query = $this->db->prepare('SELECT c.id as categoryID, c.category_name as categoryName FROM categories WHERE categoryID = ?');
        $query->execute([$categoryID]);
        $category = $query->fetch(PDO::FETCH_OBJ);
        return $category;
    }
}