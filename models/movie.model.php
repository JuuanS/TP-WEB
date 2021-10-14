<?php

class MoviesModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getAllMovies() {
        $query = $this->db->prepare('SELECT m.id as movieID,  m.movie_title as title, m.movie_description as description, c.id as categoryID, c.category_name as categoryName FROM movies m JOIN categories c ON m.category_id = c.id');
        $query->execute();
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }

    function getMovieByID($movieID) {
        $query = $this->db->prepare('SELECT m.id as movieID,  m.movie_title as title, m.movie_description as description, c.id as categoryID, c.category_name as categoryName FROM movies m JOIN categories c ON m.category_id = c.id WHERE m.id = ?');
        $query->execute([$movieID]);
        $movie = $query->fetchAll(PDO::FETCH_OBJ);
        return $movie[0];
    }

    function getMoviesByFilter($title, $category) {
        if (!$title && !$category ) {
            $this->getAllMovies();
        } else {
            if ($title && $category) {            
                $query = $this->db->prepare('SELECT m.id as movieID,  m.movie_title as title, m.movie_description as description, c.id as categoryID, c.category_name as categoryName FROM movies m JOIN categories c ON m.category_id = c.id WHERE m.movie_title LIKE ? OR m.category_id = ?');
                $query->execute([$title, $category]);
            } else if ($title) {
                $query = $this->db->prepare('SELECT m.id as movieID,  m.movie_title as title, m.movie_description as description, c.id as categoryID, c.category_name as categoryName FROM movies m JOIN categories c ON m.category_id = c.id WHERE m.movie_title LIKE ?');
                $query->execute([$title]);
            } else if ($category) {
                $query = $this->db->prepare('SELECT m.id as movieID,  m.movie_title as title, m.movie_description as description, c.id as categoryID, c.category_name as categoryName FROM movies m JOIN categories c ON m.category_id = c.id WHERE m.category_id = ?');
                $query->execute([$category]);
            }
            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;
        }
    }

    function insertMovie($title, $description, $categoryID) {
        $query = $this->db->prepare('INSERT INTO movies(movie_title, movie_description, category_id) VALUES (?, ?, ?)');
        $query->execute([$title, $description, $categoryID]);

        return $this->db->lastInsertId();
    }

    function deleteMovie($movieID) {    
        $query = $this->db->prepare('DELETE FROM movies WHERE id = ?');
        $query->execute([$movieID]);
    }

    function updateMovie($movieID, $title, $description, $categoryID) {
        $query = $this->db->prepare('UPDATE movies SET movie_title = ?, movie_description = ?, category_id = ? WHERE id = ?');
        $query->execute([$title, $description, $categoryID, $movieID]);
    }
}