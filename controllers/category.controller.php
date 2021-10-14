<?php
require_once 'models/user.model.php';
require_once 'views/category.view.php';
require_once 'helpers/auth.helper.php';

class CategoryController {
    private $categoryModel;
    private $categoryView;
    private $authHelper;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
        $this->categoryView = new CategoryView();
        $this->authHelper = new AuthHelper();

        $this->authHelper->checkLoggedIn();
    }

    function redirectToCategories()
    {
        header("Location: " . BASE_URL . "categorias");
    }

    public function showCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        $this->categoryView->showCategories($categories, $categories);
    }

    public function showAddCategory()
    {
        $mode = 'create';
        $this->categoryView->showCategoryForm(null, $mode);
    }

    public function showEditCategory($categoryID)
    {
        $category = $this->categoryModel->getCategoryByID($categoryID);
        $mode = 'edit';
        $this->categoryView->showCategoryForm($category, $mode);
    }

    function addCategory()
    {
        $categoryName = $_REQUEST['categoryName'];

        if (!empty($categoryName)) {
            $this->categoryModel->insertCategory($categoryName);
            $this->redirectToCategories();
        }
    }

    function deleteCategory($categoryID)
    {
        $this->categoryModel->deleteCategory($categoryID);
        $this->redirectToCategories();
    }

    function updateCategory($categoryID)
    {
        $categoryName = $_REQUEST['categoryName'];
        $this->categoryModel->updateCategory($categoryID, $categoryName);
        $this->redirectToCategories();
    }
}