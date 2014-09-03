<?php

class BasketModel extends Model
{
    /**
     * @param $id id товара
     * @return array свойства товара
     */
    public static function getProduct($id)
    {
        $product = self::getDbc()->prepare("SELECT `id`, name AS `productName`, `img`, `price` FROM ".APP_DB_PREFIX."products WHERE `id` = :id");
        $product->bindParam(":id", $id, PDO::PARAM_INT);
        $product->execute();
        return $product->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id id товара, который необходимо удалить
     */
    public static function removeBasket($id){
        $i = 0;
        foreach($_SESSION["basket"] as $itemBasket){
            if($itemBasket["id"] == $id){
                if((int)$itemBasket["num"] > 1){
                    $_SESSION["basket"] [$i] ["num"] = $_SESSION["basket"] [$i] ["num"] - 1;
                }else{
                    unset($_SESSION["basket"] [$i]);
                    if(empty($_SESSION["basket"])){
                        unset($_SESSION["summ"]);
                        unset($_SESSION["data"]);
                    }
                }
            }
            $i ++;
        }
        if(isset($_SESSION["basket"])){
            $tmp = array();
            foreach($_SESSION["basket"] as $sessionItem){
                $tmp[] = $sessionItem;
            }
            unset($_SESSION["basket"]);
            foreach($tmp as $tmpItem){
                $_SESSION["basket"][] = $tmpItem;
            }
        }
    }
}