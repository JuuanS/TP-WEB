<?php
require_once 'models/user.model.php';
require_once 'views/category.view.php';
require_once 'helpers/auth.helper.php';
require_once 'views/movie.view.php';

class CategoryController
{
    private $categoryModel;
    private $categoryView;
    private $authHelper;
    private $movieModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->categoryView = new CategoryView();
        $this->movieModel = new MovieModel();
        $this->authHelper = new AuthHelper();
    }

    function redirectToCategories()
    {
        header("Location: " . BASE_URL . "categorias");
    }

    public function showCategories()
    {
        $this->authHelper->checkAdminPermission();
        $categories = $this->categoryModel->getAllCategories();
        $this->categoryView->showCategories($categories);
    }

    public function showAddCategory()
    {
        $this->authHelper->checkAdminPermission();
        $mode = 'create';
        $this->categoryView->showCategoryForm(null, $mode);
    }

    public function showEditCategory($categoryID)
    {
        $this->authHelper->checkAdminPermission();
        $category = $this->categoryModel->getCategoryByID($categoryID);
        $mode = 'edit';
        $this->categoryView->showCategoryForm($category, $mode);
    }

    function addCategory()
    {
        $this->authHelper->checkAdminPermission();
        $categoryName = $_REQUEST['categoryName'];

        if (!empty($categoryName)) {
            $this->categoryModel->insertCategory($categoryName);
            $this->redirectToCategories();
        } else {
            $this->categoryView->showCategoryForm(null, 'create', 'Error Creando Categoria');
        }
    }

    function deleteCategory($categoryID)
    {
        $this->authHelper->checkAdminPermission();
        $movies = $this->movieModel->getMovies(0, 100, null, $categoryID);
        if (count($movies) === 0) {
            $this->categoryModel->deleteCategory($categoryID);
            $this->redirectToCategories();
        } else {
            $categories = $this->categoryModel->getAllCategories();
            $this->categoryView->showCategories($categories, 'No se puede eliminar la categoria, ya que tiene peliculas asociadas.');
        }
    }

    function updateCategory($categoryID)
    {
        $this->authHelper->checkAdminPermission();
        $categoryName = $_REQUEST['categoryName'];
        if (!empty($categoryName)) {
            $this->categoryModel->updateCategory($categoryID, $categoryName);
            $this->redirectToCategories();
        } else {
            $category = $this->categoryModel->getCategoryByID($categoryID);
            $this->categoryView->showCategoryForm($category, 'edit', 'Error Editando Categoria');
        }
    }
}
