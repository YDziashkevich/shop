<?php

class UserController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new UserModel();
        parent::__construct();
    }

    /**
     * страница с историей заказов пользователя
     */
    public function indexAction()
    {
        $orders = $this->user->getOrders($_SESSION["user"]["id"]);
        foreach($orders as $valueOrder){
            $data["orders"]["$valueOrder[id]"] = $this->user->getOrder($valueOrder["id"]);
            $data["orders"]["$valueOrder[id]"]["date"] = $valueOrder["date"];
        }
        $this->view->render("user/index",$data);
    }
    /**
     * список заказов
     */
    public function managerAction()
    {
        $lastOrderId = $this->user->getLastOrders();
        $i = 0;
        foreach($lastOrderId as $valueId){
            $data["orders"][$i] = $this->user->getOrder($valueId["id"]);
            $data["orders"][$i]["data"] = $this->user->getDataOrder($valueId["id"]);
            $i ++;
        }
        $this->view->render("user/manager", $data);
    }
}