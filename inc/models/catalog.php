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
        $query = "SELECT st_products.id, st_products.name, st_products.description, st_products.price, st_products.img,
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

    /**
     * @param $id идетентификатор товара
     * @return array данные о товаре
     */
    public function getProductData($id)
    {
        $product = self::getDbc()->prepare("SELECT st_products.`id`, st_products.`name` AS productName, st_products.`description`, st_products.`img`,
st_products.`price`, st_properties.`property`, st_product2property.`value` FROM `st_product2property`
JOIN `st_products` ON `st_products`.`id` = `st_product2property`.`idProduct`
JOIN `st_properties` ON `st_properties`.`id` = st_product2property.`idProperty`
 WHERE st_products.`id` = :id");
        $product->bindParam(":id", $id, PDO::PARAM_INT);
        $product->execute();
        return $product->fetchAll(PDO::FETCH_ASSOC);
    }

}