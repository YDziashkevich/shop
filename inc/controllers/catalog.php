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
        $products = self::$catalog->getProductsLimit($category);
        return $products;
    }
    /**
     * главная страница каталога
     */
    public function indexAction()
    {
        $this->add2basket("catalog/index");
        $this->view->render("catalog/index");
    }
    /**
     * страница с товарами для определенной категории
     * @param $category
     */
    public function categoryAction($category)
    {
        $this->add2basket("catalog/category");
        $categoryName = self::$catalog->getCategoryName($category[0]);
        $data["products"] = self::$catalog->getProducts($category[0]);
        $data["category"] = $categoryName;
        $this->view->render("catalog/category", $data);
    }
    /**
     * страница товара
     * @param $product информация о товаре
     */
    public function productAction($product)
    {
        $this->add2basket("catalog/product");
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
        var_dump($_SESSION["basket"]);
        $this->view->render("catalog/product", $data);
    }

    /**
     * @param $page страница на которую пенапрвляется пользователь
     */
    private function add2basket($page)
    {
        if(isset($_POST["addBasket"]) && !empty($_POST["addBasket"])){
            $numProducts = MainModel::addBasket($_POST["idProduct"]);
        }
        if($numProducts){
            header('Location: '. $_SERVER["REQUEST_URI"]);
            exit();
        }
    }
}