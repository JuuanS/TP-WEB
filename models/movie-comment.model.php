<?php

class MovieCommentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost:3307;' . 'dbname=db_movietracker;charset=utf8', 'root', '');
    }

    function getComments($movieID, $searchVote, $sortVote, $sortDate)
    {
        $sql = 'SELECT mc.comment, mc.vote, mc.id as commentID, mc.movie_id as movieID, u.user_name as userName, mc.comment_date as commentDate FROM movie_comments mc JOIN users u ON mc.user_id = u.id WHERE mc.movie_id = ? ';
        $conditions = [];
        $parameters = [];

        $parameters[] = $movieID;

        if ($searchVote && !empty($searchVote)) {
            $conditions[] = ' AND mc.vote = ? ';
            $parameters[] = $searchVote;
        }

        if ($sortDate && !empty($sortDate)) {
            $conditions[] = ' ORDER BY mc.comment_date ' . $sortDate;
            if ($sortVote && !empty($sortVote)) {
                $conditions[] = ', mc.vote ' . $sortVote;
            }
        } else {
            if ($sortVote && !empty($sortVote)) {
                $conditions[] = ' ORDER BY mc.vote ' . $sortVote;
            }
        }

        if ($conditions) {
            $sql .= implode($conditions);
        }

        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function getCommentByID($commentID)
    {
        $query = $this->db->prepare('SELECT * FROM movie_comments mc WHERE mc.id = ?');
        $query->execute([$commentID]);
        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

    function createComment($commentText, $vote, $movieID, $userID)
    {
        $query = $this->db->prepare('INSERT INTO movie_comments(movie_id, user_id, comment, vote) VALUES (?, ?, ?, ?)');
        $query->execute([$movieID, $userID, $commentText, $vote]);
        return $this->db->lastInsertId();
    }

    function deleteComment($commentID)
    {
        $query = $this->db->prepare('DELETE FROM movie_comments WHERE id = ?');
        $query->execute([$commentID]);
    }
}
