<?php

class MainModel extends Model
{
    /**
     * @return array 9 последних товаров, в случайном порядке
     */
    public static function getProducts()
    {
        $products = self::getDbc()->query("SELECT * FROM (SELECT * FROM ".APP_DB_PREFIX."products ORDER BY id DESC LIMIT 9) AS products ORDER BY RAND()");
        return $products->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $name имя пользователя, по умолчанию = Гость
     * @return string id пользователя
     */
    public static function getIdUser($name)
    {
        $id = self::getDbc()->prepare("SELECT id FROM st_users WHERE `name` = :name");
        $id->bindParam(":name", $name);
        $id->execute();
        return $id->fetchColumn();
    }

    /**
     * @param string $idProduct id товара
     * @return bool|int если нет записи в сессии то false, или общее количество товаров
     */
    public static function addBasket($idProduct = ""){
        if(!isset($_SESSION["basket"]) && empty($_SESSION["basket"])){
            $_SESSION["basket"][0]["id"] = $idProduct;
            $_SESSION["basket"][0]["num"] = 1;
        }elseif(isset($_SESSION["basket"]) && !empty($_SESSION["basket"])){
            $addNewItem = true;
            $i = 0;
            foreach($_SESSION["basket"] as $itemBasket){
                if($itemBasket["id"] == $idProduct){
                    $_SESSION["basket"][$i]["num"] += 1;
                    $addNewItem = false;
                }
                $i ++;
            }
            if($addNewItem){
                $numItems = count($_SESSION["basket"]);
                $_SESSION["basket"][$numItems]["id"] = $idProduct;
                $_SESSION["basket"][$numItems]["num"] = 1;
            }
        }
        if(isset($_SESSION["basket"]) && !empty($_SESSION["basket"])){
            $numProducts = 0;
            foreach($_SESSION["basket"] as $itemBasket){
                $numProducts +=  $itemBasket["num"];
            }
            return $numProducts;
        }else{
            return false;
        }
    }
}