<?php

class CatalogController extends Controller
{
    private static $catalog;

    public function __construct()
    {
        parent::__construct();
        self::$catalog = new CatalogModel();
    }

    public static function getProducts($category)
    {
        return self::$catalog->getProducts($category);
    }

    public function indexAction()
    {
        $this->view->render("catalog/index");
    }

    public function categoryAction($category)
    {

    }

}