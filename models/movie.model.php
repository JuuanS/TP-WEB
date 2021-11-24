<?php

class MovieModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getMovies($offset, $limit, $title, $category)
    {
        $sql = 'SELECT m.id as movieID, m.movie_title as title, m.movie_description as description, c.id as categoryID, c.category_name as categoryName, m.image_url as imageUrl FROM movies m JOIN categories c ON m.category_id = c.id';
        $conditions = [];
        $titleParam = '';

        if (!empty($title)) {
            $conditions[] = 'm.movie_title LIKE :movieTitle';
            $titleParam = "%" . $title . "%";
        }

        if (!empty($category)) {
            if (!empty($title)) {
                $conditions[] = ' AND m.category_id = :category';
            } else {
                $conditions[] = 'm.category_id = :category';
            }
        }

        if ($conditions) {
            $conditions[] = ' LIMIT :limit OFFSET :offset';
            $sql .= " WHERE " . implode($conditions);
        } else {
            $conditions[] = ' LIMIT :limit OFFSET :offset';
            $sql .= implode($conditions);
        }

        $query = $this->db->prepare($sql);
        if (!empty($title)) {
            $query->bindParam(':movieTitle', $titleParam, PDO::PARAM_STR);
        }
        if (!empty($category)) {
            $query->bindParam(':category', $category, PDO::PARAM_INT);
        }
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }

    function getMoviesCount($title, $category)
    {
        $sql = 'SELECT COUNT(m.id) as collectionSize FROM movies m JOIN categories c ON m.category_id = c.id';
        $conditions = [];
        $parameters = [];

        if (!empty($title)) {
            $conditions[] = 'm.movie_title LIKE ?';
            $parameters[] = '%' . $title . "%";
        }

        if (!empty($category)) {
            $conditions[] = 'm.category_id = ?';
            $parameters[] = $category;
        }

        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        $collectionSize = $query->fetchColumn();
        return $collectionSize;
    }

    function getMovieByID($movieID)
    {
        $query = $this->db->prepare('SELECT m.id as movieID,  m.movie_title as title, m.movie_description as description, c.id as categoryID, c.category_name as categoryName, m.image_url as imageUrl FROM movies m JOIN categories c ON m.category_id = c.id WHERE m.id = ?');
        $query->execute([$movieID]);
        $movie = $query->fetch(PDO::FETCH_OBJ);
        return $movie;
    }

    function insertMovie($title, $description, $categoryID)
    {
        $query = $this->db->prepare('INSERT INTO movies(movie_title, movie_description, category_id) VALUES (?, ?, ?)');
        $query->execute([$title, $description, $categoryID]);

        return $this->db->lastInsertId();
    }

    function deleteMovie($movieID)
    {
        $query = $this->db->prepare('DELETE FROM movies WHERE id = ?');
        $query->execute([$movieID]);
    }

    function updateMovie($movieID, $title, $description, $categoryID, $path_img)
    {
        $query = $this->db->prepare('UPDATE movies SET movie_title = ?, movie_description = ?, category_id = ?, image_url = ? WHERE id = ?');
        $query->execute([$title, $description, $categoryID, $path_img, $movieID]);
    }
}
