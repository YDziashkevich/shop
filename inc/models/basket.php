<?php

class BasketModel extends Model
{

    /**
     * @param $id id товара
     * @return array свойства товара
     */
    public static function getProduct($id)
    {
        $product = self::getDbc()->prepare("SELECT `id`, name AS `productName`, `img`, `price` FROM st_products WHERE `id` = :id");
        $product->bindParam(":id", $id, PDO::PARAM_INT);
        $product->execute();
        return $product->fetch(PDO::FETCH_ASSOC);
    }
}