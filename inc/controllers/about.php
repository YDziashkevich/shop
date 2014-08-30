<?php

class AboutController extends Controller
{

    public function indexAction()
    {
        $this->view->render("about/index");
    }

}