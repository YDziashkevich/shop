<?php

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        var_dump($_SESSION["order"]);
        session_unset();
        session_destroy();
        $this->view->render("order/index");
    }

}