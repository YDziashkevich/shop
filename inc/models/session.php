<?php

class SessionModel
{
    /**
     * запуск сессии
     */
    public function __construct(){
        session_start();
    }
}