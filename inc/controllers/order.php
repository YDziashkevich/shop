<?php

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render("order/index");
    }

}