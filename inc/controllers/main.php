<?php

class MainController extends Controller
{

    /**
     * главная страница
     */
    public function indexAction()
    {
        $products = MainModel::getProducts();
        shuffle($products);
        $data["products"] = array_slice($products, 0, 9);
        $this->view->render("main/index", $data);
    }
}