<?php

class BasketController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * вывод корзины
     * @param string $product id продукта
     */
    public function indexAction($product = "")
    {
        $controllerFlag = strpos($product[0], "!");
        if($controllerFlag === false){
            $data = $this->add2basket($product);
        }else{
            $i = 0;
            $id = str_replace("!","",$product[0]);
            var_dump($id);
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
            foreach($_SESSION["order"] as $value){
                $item = BasketModel::getProduct($value["id"]);
                foreach($item as $val){
                    $data["element"][]= $val;
                    $data["element"][$j]["numProduct"] = $value["num"];
                }
                $j ++;
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
        $data = array();
        if(!empty($product)){
            $flag = true;
            if(!empty($_SESSION) && isset($_SESSION["order"])){
                $i = 0;
                foreach($_SESSION["order"] as $itemOrder){
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
            $j = 0;
            foreach($_SESSION["order"] as $value){
                $item = BasketModel::getProduct($value["id"]);
                foreach($item as $val){
                    $data["element"][]= $val;
                    $data["element"][$j]["numProduct"] = $value["num"];
                }
                $j ++;
            }
        }elseif(empty($product) && !empty($_SESSION) && isset($_SESSION["order"])){
            $j = 0;
            foreach($_SESSION["order"] as $value){
                $item = BasketModel::getProduct($value["id"]);
                foreach($item as $val){
                    $data["element"][]= $val;
                    $data["element"][$j]["numProduct"] = $value["num"];
                }
                $j ++;
            }
        }else{
            $data["element"][]= null;
        }
        return $data;
    }

}