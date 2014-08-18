<?php

class BasketController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render("basket/index");
    }

}