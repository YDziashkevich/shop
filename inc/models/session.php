<?php

class SessionModel
{
    /**
     * запуск сессии
     */
    public function __construct(){
        session_start();
    }

    public function isLoggedIn(){
        return isset($_SESSION['login']);
    }

    public function logout(){
        session_destroy();
    }

}