<?php

// include_once ROOT . '/models/Category.php';
// include_once ROOT . '/models/Product.php';
// include_once ROOT . '/components/Pagination.php';

class CatalogController
{


    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProduct = [];
        $latestProduct = Product::getLatestProducts();

        require_once(ROOT . '/views/catalog/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        // echo 'Category: ' . $categoryId;
        // echo '<br>Page: ' . $page;
        $categories = [];
        $categories = Category::getCategoriesList();

        $categoriesProducts = [];
        $categoriesProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotalProductInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, '');

        require_once(ROOT . '/views/catalog/category.php');

        return true;
    }
}
