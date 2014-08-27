<?php

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $products = array();
        $data = array();
        $products = MainModel::getProducts();
        shuffle($products);
        $data["products"] = array_slice($products, 0, 9);
        $this->view->render("main/index", $data);
    }
}