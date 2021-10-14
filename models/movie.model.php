<?php

class MoviesModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getAllMovies() {
        $query = $this->db->prepare('SELECT * FROM movies m JOIN categories c ON m.categoryID = c.categoryID');
        $query->execute();
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }

    function getMovieByID($movieID) {
        $query = $this->db->prepare('SELECT * FROM movies m JOIN categories c ON m.categoryID = c.categoryID WHERE m.movieID = ?');
        $query->execute([$movieID]);
        $movie = $query->fetchAll(PDO::FETCH_OBJ);
        return $movie[0];
    }

    function getMoviesByFilter($title, $category) {
        if (!$title && !$category ) {
            $this->getAllMovies();
        } else {
            if ($title && $category) {            
                $query = $this->db->prepare('SELECT * FROM movies m JOIN categories c ON m.categoryID = c.categoryID WHERE m.title LIKE ? OR m.categoryID = ?');
                $query->execute([$title, $category]);
            } else if ($title) {
                $query = $this->db->prepare('SELECT * FROM movies m JOIN categories c ON m.categoryID = c.categoryID WHERE m.title LIKE ?');
                $query->execute([$title]);
            } else if ($category) {
                $query = $this->db->prepare('SELECT * FROM movies m JOIN categories c ON m.categoryID = c.categoryID WHERE m.categoryID = ?');
                $query->execute([$category]);
            }
            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;
        }
    }

    function insertMovie($title, $description, $categoryID) {
        $query = $this->db->prepare('INSERT INTO movies(title, description, categoryID) VALUES (?, ?, ?)');
        $query->execute([$title, $description, $categoryID]);

        return $this->db->lastInsertId();
    }

    function deleteMovie($movieID) {    
        $query = $this->db->prepare('DELETE FROM movies WHERE movieID = ?');
        $query->execute([$movieID]);
    }

    function updateMovie($movieID, $title, $description, $categoryID) {
        $query = $this->db->prepare('UPDATE movies SET title = ?, description = ?, categoryID = ? WHERE movieID = ?');
        $query->execute([$title, $description, $categoryID, $movieID]);
    }
}