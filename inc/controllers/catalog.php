<?php

class CatalogController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render("catalog/index");
    }

}