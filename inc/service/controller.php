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
        if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
            //не зарегистрированный пользовател = Гость
            $_SESSION["user"]["name"] = "guest";
        }
    }

    public function redirect($url){
        header('Location: '.$url);
        die();
    }
}