<?php

class OrderModel extends Model
{
    private $data = array();
    /**
     * @return array данные из формы
     */
    private function getFormData()
    {
        $formData = array();
        $formData["name"] = isset($_POST["name"]) ? trim($_POST["name"]) : "";
        $formData["address"] = isset($_POST["address"]) ? trim($_POST["address"]) : "";
        $formData["phone"] = isset($_POST["phone"]) ? trim($_POST["phone"]) : "";
        return $formData;
    }
    /**
     * @return bool результат валидации данных формы
     */
    public function isValid(){
        $valid = true;
        $this->data = $this->getFormData();
        if(strlen($this->data["name"]) < 3){
            $errors["nameError"] = "Имя короче 3 символов";
            $valid = false;
        }
        if(!preg_match("/[+] [0-9]{5} [0-9]{3}[-][0-9]{2}[-][0-9]{2}/i",$this->data["phone"])){
            $errors["phoneError"] = "Введенный мобильный телефон не соответствует шаблону: + 12345 123-45-67 ";
            $valid = false;
        }
        if($valid){
            return true;
        }else{
            return $errors;
        }
    }
    /**
     * @param $name имя пользователя
     * @return array id ползователя
     */
    public function getIdUser($name)
    {
        $id = self::getDbc()->prepare("SELECT * FROM ".APP_DB_PREFIX."users WHERE `name` = :name");
        $id->bindParam(":name", $name);
        $id->execute();
        return $id->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * @param array $product товары в заказе
     * @param $name имя заказчика
     * @return bool|string результат действия сохраниения заказа
     */
    public function saveOrder($product = array(), $name)
    {
        $user = $this->getIdUser($name);
        $idUser = $user["id"];
        if($name == APP_BASE_USER){
            $order = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."orders (idUser, name, address, phone) VALUES (:idUser, :name, :address, :phone)");
            $order->bindParam("idUser", $idUser, PDO::PARAM_INT);
            $order->bindParam(":name", $this->data["name"]);
            $order->bindParam(":address", $this->data["address"]);
            $order->bindParam(":phone", $this->data["phone"]);
            $addOrder = $order->execute();
            $lastId = self::getDbc()->lastInsertId();
            $flagItems = 0;
            foreach($product as $productValue){
                $items = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."items (idOrder, idProduct, numProduct) VALUES (:idOrder, :idProduct, :numProduct)");
                $items->bindParam(":idOrder", $lastId, PDO::PARAM_INT);
                $items->bindParam(":idProduct", $productValue["id"], PDO::PARAM_INT);
                $items->bindParam(":numProduct", $productValue["num"], PDO::PARAM_INT);
                $addItems = $items->execute();
                if($addItems === false){
                    $flagItems ++;
                }
            }
            //если зарегистрированный пользователь
        }else{
            $order = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."orders (idUser, name, address, phone) VALUES (:idUser, :name, :address, :phone)");
            $order->bindParam("idUser", $idUser, PDO::PARAM_INT);
            $order->bindParam(":name", $name);
            $order->bindParam(":address", $user["address"]);
            $order->bindParam(":phone", $user["phone"]);
            $addOrder = $order->execute();
            $lastId = self::getDbc()->lastInsertId();
            $flagItems = 0;
            foreach($product as $productValue){
                $items = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."items (idOrder, idProduct, numProduct) VALUES (:idOrder, :idProduct, :numProduct)");
                $items->bindParam(":idOrder", $lastId, PDO::PARAM_INT);
                $items->bindParam(":idProduct", $productValue["id"], PDO::PARAM_INT);
                $items->bindParam(":numProduct", $productValue["num"], PDO::PARAM_INT);
                $addItems = $items->execute();
                if($addItems === false){
                    $flagItems ++;
                }
            }
        }
        if($addOrder === true && $flagItems == 0){
            return $lastId;
        }else{
            return false;
        }
    }
    /**
     * @param $id id товара
     * @return array данные о товаре
     */
    public function getProduct($id)
    {
        $product = self::getDbc()->prepare("SELECT name AS productName, price FROM ".APP_DB_PREFIX."products WHERE `id` = :id");
        $product->bindParam(":id", $id, PDO::PARAM_INT);
        $product->execute();
        return $product->fetchAll(PDO::FETCH_ASSOC);
    }
}