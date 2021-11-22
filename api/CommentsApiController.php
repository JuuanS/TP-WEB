<?php
require_once 'models/movie-comment.model.php';
require_once 'models/movie.model.php';
require_once 'api/ApiController.php';
require_once("./api/JSONView.php");
require_once 'helpers/auth.helper.php';
require_once 'helpers/api.helper.php';

class CommentsApiController
{

    private $commentModel;
    private $movieModel;
    private $view;
    private $apiHelper;
    private $authHelper;

    public function __construct()
    {
        $this->commentModel = new MovieCommentModel();
        $this->movieModel = new MovieModel();
        $this->view = new JSONView();
        $this->authHelper = new AuthHelper();
        $this->apiHelper = new ApiHelper();
    }

    public function getComments($params = [])
    {
        $movieID = $params[':ID'];
        $sortVote = null;
        $sortDate = null;
        if (isset($_GET['sortVote'])) {
            $sortVote = $_GET['sortVote'];
        }
        if (isset($_GET['sortDate'])) {
            $sortDate = $_GET['sortDate'];
        }
        $movie = $this->movieModel->getMovieByID($movieID);
        if ($movie) {
            $comments = $this->commentModel->getComments($movieID, $sortVote, $sortDate);
            $this->view->response($comments, 200);
        } else {
            $this->view->response("No se encontro la pelicula con id=$movieID", 404);
        }
    }

    public function addComment($params = null)
    {
        $body = $this->apiHelper->getData();

        $commentText = $body->comment;
        $vote = $body->vote;
        $movieID = $body->movieID;
        $userID = $this->authHelper->getLoggedUserID();

        $commentID = $this->commentModel->createComment($commentText, $vote, $movieID, $userID);
        $newComment = $this->commentModel->getCommentByID($commentID);
        if ($newComment) {
            $this->view->response($newComment, 200);
        } else {
            $this->view->response("Error al crear comentario", 500);
        }
    }

    public function deleteComment($params = [])
    {
        $commentID = $params[':ID'];
        $comment = $this->commentModel->getCommentByID($commentID);
        if ($comment) {
            $this->commentModel->deleteComment($commentID);
            $this->view->response("Usuario eliminado con exito", 201);
        } else {
            $this->view->response("No se encontro el usuario con id=$commentID", 404);
        }
    }
}
