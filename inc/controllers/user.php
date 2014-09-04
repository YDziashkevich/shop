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
}