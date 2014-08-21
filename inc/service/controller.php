<?php

class Controller
{
    protected $view;
    protected $session;

    /**
     * создание объектов для отображения и сессии
     */
    public function __construct(){
        $this->view = new View();
        $this->session = new SessionModel();
        ob_start();

        // Подлючение модели контактов
        $contact = new ContactModel();
        $this->contact = $contact;
        $this->view->contact = $this->contact;

        // Подлючение модели aдминки(категории)
        $admincatalog = new adminCatalogModel();
        $this->admincatalog = $admincatalog;
        $this->view->admincatalog = $this->admincatalog;
    }

    public function redirect($url){
        header('Location: '.$url);
        die();
    }
}