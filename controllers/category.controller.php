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
        header("Location: " . BASE_URL . "categorias");
    }

    function addCategory()
    {
        $categoryName = $_REQUEST['category'];
        if (!empty($title)) {
            $this->categoryModel->insertCategory($categoryName);
            $this->redirectToCategories();
        } else {
            //$this->categoryView->showFormCategory("Mensaje Error");
        }
    }

    function deleteCategory($categoryID)
    {
        $movies[] = $this->movieModel->getMoviesByFilter(null, $categoryID);
        if (!$movies) {
            $this->categoryModel->deleteCategory($categoryID);
            $this->redirectToCategories();
        } else {
            //$this->categoryView->showFormCategory("Mensaje Error");
        }
       
    }

    function updateCategory($categoryID)
    {
        $categoryID = $_REQUEST['category'];
        $this->categoryModel->updateCategory($categoryID, $$categoryName);
        $this->redirectToCategories();
    }
}