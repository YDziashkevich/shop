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
            $products = $products[0];
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
        $data["category"] = $categoryName;
        $this->view->render("catalog/category", $data);
    }

    /**
     * страница товара
     * @param $product информация о товаре
     */
    public function productAction($product)
    {
        $data = array();
        $property = array();
        $productData = self::$catalog->getProductData($product[0]);
        foreach($productData as $item){
            $tmp1 = "";
            $tmp2 = "";
            foreach($item as $key=>$value){
                if($key == "property"){
                    $tmp1 = $value;
                }elseif($key == "value"){
                    $tmp2 = $value;
                }else{
                    $data["$key"] = $value;
                }
            }
            $property[$tmp1] = $tmp2;
        }
        $data["property"] = $property;

        $this->view->render("catalog/product", $data);
    }
}