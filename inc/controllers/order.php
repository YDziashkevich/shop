<?php

class OrderController extends Controller
{
    private $order;

    public function __construct()
    {
        parent::__construct();
        $this->order = new OrderModel();
    }

    /**
     * вывод страницы оформления заказа
     */
    public function indexAction()
    {
        //по умолчанию категория пользователей - гость
        $user = "guest";

        //получаем заказ из сессии
        if(!empty($_SESSION) && isset($_SESSION["order"])){
            foreach($_SESSION["order"] as $value){
                $order[] = $value;
            }
        }

        if($user == "guest"){
        //валидация введенных данных
            if(!empty($_POST) && isset($_POST["ok"])){
                $valid = $this->order->isValid();
            }
            //добавление заказа
            if($valid === true){
                $this->saveOrder($order, $user);
                header('Location: '. APP_BASE_URL . "order/order");
                exit();
            }else{
                $this->view->render("order/index",$valid);
            }
        }else{


        }
    }

    /**
     * вывод страницы чека заказа
     */
    public function orderAction(){
        $data = array();
        if(!empty($_SESSION) && isset($_SESSION["data"])){
            foreach($_SESSION["data"] as $key=>$value){
                $data[$key] = $value;
            }
        }
        session_unset();
        $this->view->render("order/order",$data);
    }

    /**
     * @param array $order массив товаров
     * @param string $user иимя пользователя
     */
    private function saveOrder($order = array(), $user = ""){
        $idOrder = $this->order->saveOrder($order, $user);

        $i = 0;
        foreach($order as $valueOrder){
            foreach($this->order->getProduct($valueOrder["id"]) as $productsValue){
                $products[] = $productsValue;
                $products[$i]["num"] = $valueOrder["num"];
            }
            $i ++;
        }

        foreach($products as $product){
            $_SESSION ["data"] ["products"] [] =$product;
        }

        $_SESSION ["data"] ["idOrder"] = $idOrder;
        $_SESSION ["data"] ["summ"] = $_SESSION["summ"];

    }


}