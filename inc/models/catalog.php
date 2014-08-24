<?php

class CatalogModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $category id категории
     * @return array массив с всеми товарами для полученной категории
     */
    public function getProducts($category)
    {
        $query = "SELECT st_products.name, st_products.description, st_products.price, st_products.img,
st_category.name AS category FROM st_products INNER JOIN st_category
WHERE st_category.id = '" .  $category . "' AND st_products.idCategory = st_category.id ";
        $products = self::getDbc()->query($query);
        return $products->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $categoryId id категории
     * @return array имя категории
     */
    public static function getCategoryName($categoryId)
    {
        $category = self::getDbc()->prepare("SELECT `name` FROM `st_category` WHERE `id` = :categoryId");
        $category->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
        $category->execute();
        return $category->fetchAll(PDO::FETCH_ASSOC);
    }

}