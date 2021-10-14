<?php
require_once 'models/user.model.php';
require_once 'views/auth.view.php';
require_once 'helpers/auth.helper.php';

class CategoryController {
    private $categoryModel;
    private $categoryView;
    private $movieModel;
    private $authHelper;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
        $this->categoryView = new CategoryView();
        $this->movieModel = new MovieModel();
        $this->authHelper = new AuthHelper();
    }

    function redirectToCategories()
    {
        header("Location: " . BASE_URL . "peliculas");
    }

    function addCategory()
    {
        $categoryName = $_REQUEST['category'];

        if (!empty($title)) {
            $this->categoryModel->insertCategory($categoryName);
            $this->redirectToCategories();
        } else {
            //MOSTRAR ERROR
        }
    }

    function deleteCategory($categoryID)
    {
        //VALIDAR QUE NO ESTE ASOCIADA A NINGUNA PELICULA
        // $queryMovies = $this->db->prepare('SELECT COUNT(*) FROM movies WHERE category_id = ?');
        // $queryMovies->execute([$categoryID]);
        // $asociatedMovies = $queryMovies->fetch(PDO::FETCH_OBJ);
        // if ($asociatedMovies === 0) {

        $this->categoryModel->deleteCategory($categoryID);
        $this->redirectToCategories();
    }

    function updateCategory($categoryID)
    {
        $categoryID = $_REQUEST['category'];
        $this->categoryModel->updateCategory($categoryID, $$categoryName);
        $this->redirectToCategories();
    }
}