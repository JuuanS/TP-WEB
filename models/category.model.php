<?php

class CategoryModel
{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getAllCategories()
    {
        $query = $this->db->prepare('SELECT c.id as categoryID, c.category_name as categoryName FROM categories c');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    function getCategoryByID($categoryID)
    {
        $query = $this->db->prepare('SELECT c.id as categoryID, c.category_name as categoryName FROM categories c WHERE c.id = ?');
        $query->execute([$categoryID]);
        $category = $query->fetch(PDO::FETCH_OBJ);
        return $category;
    }

    function insertCategory($categoryName)
    {
        $query = $this->db->prepare('INSERT INTO categories(category_name) VALUES (?)');
        $query->execute([$categoryName]);
        return $this->db->lastInsertId();
    }

    function deleteCategory($categoryID)
    {
        $query = $this->db->prepare('DELETE FROM categories WHERE id = ?');
        $query->execute([$categoryID]);
    }

    function updateCategory($categoryID, $categoryName)
    {
        $query = $this->db->prepare('UPDATE categories SET category_name = ? WHERE id = ?');
        $query->execute([$categoryName, $categoryID]);
    }
}
