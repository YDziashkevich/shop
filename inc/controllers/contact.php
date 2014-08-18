<?php

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render("contact/index");
    }

}