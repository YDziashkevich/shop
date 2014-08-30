<?php

class BasketController extends Controller
{

    /**
     * вывод корзины
     * @param string $product id продукта
     */
    public function indexAction($product = "")
    {
        //сигнализирует - товар добовляется или удаляется(!) из корзины
        $controllerFlag = strpos($product[0], "!");

        if($controllerFlag === false && $product[0] != "empty"){
            $data = $this->add2basket($product);
            //очищает корзину
        }elseif($product[0] == "empty"){
            session_unset();
            //session_destroy();
            //удаление товара из корзины
        }else{
            $i = 0;
            $id = str_replace("!","",$product[0]);
            foreach($_SESSION["order"] as $itemOrder){
                if($itemOrder["id"] == $id){
                    if((int)$itemOrder["num"] > 1){
                        $_SESSION["order"] [$i] ["num"] = $_SESSION["order"] [$i] ["num"] - 1;
                    }else{
                        unset($_SESSION["order"] [$i]);
                        $tmp = array();
                        foreach($_SESSION["order"] as $sessionItem){
                            $tmp[] = $sessionItem;
                        }
                        unset($_SESSION["order"]);
                        foreach($tmp as $tmpItem){
                            $_SESSION["order"][] = $tmpItem;
                        }
                    }
                }
                $i ++;
            }
            $j = 0;
            //вывод оставшихся элементов корзине
            if(!empty($_SESSION["order"])){
                foreach($_SESSION["order"] as $value){
                    $item = BasketModel::getProduct($value["id"]);
                    $data["element"][]= $item;
                    $data["element"][$j]["numProduct"] = $value["num"];

                $j ++;
                }
            }
        }
        $this->view->render("basket/index", $data);
    }

    /**
     * @param string $product id продукта
     * @return array продукты с свойствами
     */
    private function add2basket($product = "")
    {

        //добавление продукта в корзину
        if(!empty($product)){

            //проверяет есть ли добовляемый товар в корзине, по умолчанию - нет
            $flag = true;

            //добовляестся в существующую в сессии переменную продукт, или создает новую
            if(!empty($_SESSION) && isset($_SESSION["order"])){
                $i = 0;
                foreach($_SESSION["order"] as $itemOrder){

                    //проверка - существует запись в сессии с полученным id
                    if($itemOrder["id"] == $product[0]){
                        $_SESSION["order"] [$i] ["num"] = $_SESSION["order"] [$i] ["num"] + 1;
                        $flag = false;
                    }
                    $i ++;
                }
                if($flag == true){
                    $_SESSION["order"][] = array("id"=>$product[0], "num"=>1);
                }
            }else{
                $_SESSION["order"][] = array("id"=>$product[0], "num"=>1);
            }

            //создаем массив с товарами в корзине и их свойствами
            $j = 0;
            foreach($_SESSION["order"] as $value){
                $item = BasketModel::getProduct($value["id"]);
                $data["element"][]= $item;
                $data["element"][$j]["numProduct"] = $value["num"];
                $j ++;
            }
            //просмотр корзины
        }elseif(empty($product) && !empty($_SESSION) && isset($_SESSION["order"])){
            $j = 0;
            foreach($_SESSION["order"] as $value){
                $item = BasketModel::getProduct($value["id"]);
                    $data["element"][]= $item;
                    $data["element"][$j]["numProduct"] = $value["num"];

                $j ++;
            }//корзина пуста
        }else{
            $data["element"][]= null;
        }
        return $data;
    }

}