<?php

class CatalogController extends Controller
{
    private static $catalog;

    public function __construct()
    {
        parent::__construct();
        self::$catalog = new CatalogModel();
    }

    /**
     * продукты для главной страницы каталога
     * @param $category id категории
     * @return array массив из последних трех продуктов
     */
    public static function getProducts($category)
    {
        $products = array_reverse(self::$catalog->getProducts($category));
        $count = count($products);
        if($count>3){
            $products = array_chunk($products, 3);
            $products  =$products[0];
        }
        return $products;
    }

    /**
     * главная страница каталога
     */
    public function indexAction()
    {
        $this->view->render("catalog/index");
    }

    /**
     * страница с товарами для определенной категории
     * @param $category
     */
    public function categoryAction($category)
    {
        $data = array();
        $categoryName = self::$catalog->getCategoryName($category[0]);
        $data["products"] = array_reverse(self::$catalog->getProducts((int)$category[0]));
        $data["category"] = $categoryName[0];
        $this->view->render("catalog/category", $data);
    }

}