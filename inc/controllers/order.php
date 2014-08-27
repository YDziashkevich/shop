<?php

class OrderController extends Controller
{
    private $order;

    public function __construct()
    {
        parent::__construct();
        $this->order = new OrderModel();
    }

    public function indexAction()
    {
        $user = "guest";
        $order = array();
        $products = array();
        if(!empty($_SESSION) && isset($_SESSION["order"])){
            foreach($_SESSION["order"] as $value){
                $order[] = $value;
            }
        }
        if(!empty($_POST) && isset($_POST["ok"])){
            $valid = $this->order->isValid();

        }
        if($valid === true){
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

            header('Location: '. APP_BASE_URL . "order/order");
            exit();
        }

        $this->view->render("order/index");
    }

    public function orderAction(){
        $data = array();
        foreach($_SESSION["data"] as $key=>$value){
            $data[$key] = $value;
        }
        var_dump($data);
        session_unset();
        session_destroy();
        session_start();
        $this->view->render("order/order",$data);
    }


}