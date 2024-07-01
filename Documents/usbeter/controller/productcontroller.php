<?php

class productController
{

    private $db;
    public function __construct()
    {
        $this->createDBConnection();

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (key_exists("category", $_GET)) {
                $this->displaySpecificCategory();
            } else if (key_exists("categories", $_GET)) {
                $this->displaySpecificCategories();
            } else {
                $this->displayAllProducts();
            }
        }
    }
    function createDBConnection()
    {
        $dbh = new Dbh();
        $this->db = $dbh->Connect();
    }

    function displayAllProducts()
    {
        $data = Product::getAllProducts($this->db);
        $sectionView = new sectionView($data['products'], $data['categories']);
        $sectionView->showView();
    }

    public function displaySpecificCategory()
    {
        $categoryName = htmlspecialchars($_GET['category']);
        $data = Product::getSpecificCategory($this->db, $categoryName);
        $sectionView = new sectionView($data['products'], $data['categories']);
        $sectionView->showView();
    }

    public function displaySpecificCategories()
    {
        $categoryNames = htmlspecialchars($_GET['categories']);
        $data = Product::getSpecificCategories($this->db, $categoryNames);
        $sectionView = new sectionView($data['products'], $data['categories']);
        $sectionView->showView();
    }
}