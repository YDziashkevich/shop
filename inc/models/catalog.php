<?php

class CatalogModel extends Model
{
    /**
     * @param $category id категории
     * @return array массив с всеми товарами для полученной категории
     */
    public function getProducts($category)
    {
        $products = self::getDbc()->prepare("SELECT ".APP_DB_PREFIX."products.id, ".APP_DB_PREFIX."products.name,
        ".APP_DB_PREFIX."products.description, ".APP_DB_PREFIX."products.price, ".APP_DB_PREFIX."products.img,
        ".APP_DB_PREFIX."category.name AS category FROM ".APP_DB_PREFIX."products INNER JOIN ".APP_DB_PREFIX."category
        WHERE ".APP_DB_PREFIX."category.id = :id AND ".APP_DB_PREFIX."products.idCategory = ".APP_DB_PREFIX."category.id
        ORDER BY ".APP_DB_PREFIX."products.id DESC");
        $products->bindParam(":id", $category, PDO::PARAM_INT);
        $products->execute();
        return $products->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param $category id категории
     * @return array массив с всеми товарами для полученной категории
     */
    public function getProductsLimit($category)
    {
        $products = self::getDbc()->prepare("SELECT ".APP_DB_PREFIX."products.id, ".APP_DB_PREFIX."products.name,
        ".APP_DB_PREFIX."products.description, ".APP_DB_PREFIX."products.price, ".APP_DB_PREFIX."products.img,
        ".APP_DB_PREFIX."category.name AS category FROM ".APP_DB_PREFIX."products INNER JOIN ".APP_DB_PREFIX."category
        WHERE ".APP_DB_PREFIX."category.id = :id AND ".APP_DB_PREFIX."products.idCategory = ".APP_DB_PREFIX."category.id
        ORDER BY ".APP_DB_PREFIX."products.id DESC LIMIT 3");
        $products->bindParam(":id", $category, PDO::PARAM_INT);
        $products->execute();
        return $products->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param $categoryId id категории
     * @return array имя категории
     */
    public static function getCategoryName($categoryId)
    {
        $category = self::getDbc()->prepare("SELECT `name` FROM `".APP_DB_PREFIX."category` WHERE `id` = :categoryId");
        $category->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
        $category->execute();
        return $category->fetchColumn();
    }
    /**
     * @param $id идетентификатор товара
     * @return array данные о товаре
     */
    public function getProductData($id)
    {
        $product = self::getDbc()->prepare("SELECT ".APP_DB_PREFIX."products.`id`, ".APP_DB_PREFIX."products.`name` AS productName,
        ".APP_DB_PREFIX."products.`description`, ".APP_DB_PREFIX."products.`img`, ".APP_DB_PREFIX."products.`price`,
        ".APP_DB_PREFIX."properties.`property`, ".APP_DB_PREFIX."product2property.`value` FROM `".APP_DB_PREFIX."product2property`
        JOIN `".APP_DB_PREFIX."products` ON `".APP_DB_PREFIX."products`.`id` = `".APP_DB_PREFIX."product2property`.`idProduct`
        JOIN `".APP_DB_PREFIX."properties` ON `".APP_DB_PREFIX."properties`.`id` = ".APP_DB_PREFIX."product2property.`idProperty`
        WHERE ".APP_DB_PREFIX."products.`id` = :id");
        $product->bindParam(":id", $id, PDO::PARAM_INT);
        $product->execute();
        return $product->fetchAll(PDO::FETCH_ASSOC);
    }
}