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
        //получаем заказ из сессии
        if(!empty($_SESSION) && isset($_SESSION["basket"])){
            foreach($_SESSION["basket"] as $value){
                $order[] = $value;
            }
        }
        //если есть зарегистрированный пользователь, нет необходимости заполнять данные
        if($_SESSION["user"]["name"] != APP_BASE_USER){
            $this->saveOrder($order, $_SESSION["user"]["name"]);
            header('Location: '. APP_BASE_URL . "order/order");
            exit();
        }
        //валидация введенных данных
        if(!empty($_POST) && isset($_POST["ok"])){
            $valid = $this->order->isValid();
        }
        //добавление заказа
        if($valid === true){
            $this->saveOrder($order, $_SESSION["user"]["name"]);
            header('Location: '. APP_BASE_URL . "order/order");
            exit();
        }else{
            $this->view->render("order/index",$valid);
        }
    }
    /**
     * вывод страницы чека заказа
     */
    public function orderAction(){
        if(!empty($_SESSION) && isset($_SESSION["data"])){
            foreach($_SESSION["data"] as $key=>$value){
                $data[$key] = $value;
            }
        }
        unset($_SESSION["basket"]);
        unset($_SESSION["summ"]);
        unset($_SESSION["data"]);
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