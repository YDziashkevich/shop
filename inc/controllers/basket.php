<?php

class BasketController extends Controller
{

    /**
     * @param string $clearBasket ссылка на очистку корзины
     */
    public function indexAction($clearBasket = "")
    {
        //очистить корзину
        if($clearBasket[0] == "empty"){
            unset($_SESSION["basket"]);
            unset($_SESSION["summ"]);
        }
        //удалить элемент с корзины
        if(isset($_POST["removeBasket"]) && !empty($_POST["removeBasket"])){
            $numProducts = BasketModel::removeBasket($_POST["idProduct"]);
        }
        if($numProducts){
            header('Location: '. APP_BASE_URL . "main/index");
            exit();
        }
        //вывод товаров в корзине
        if(isset($_SESSION["basket"]) && !empty($_SESSION["basket"])){
            $j = 0;
            foreach($_SESSION["basket"] as $value){
                $item = BasketModel::getProduct($value["id"]);
                $data["element"][]= $item;
                $data["element"][$j]["numProduct"] = $value["num"];
                $j ++;
            }
        }
        $this->view->render("basket/index", $data);
    }
}