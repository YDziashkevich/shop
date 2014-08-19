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
    }


}