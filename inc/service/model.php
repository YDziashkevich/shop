<?php

class Model
{
    protected static $dbc;

    /**
     * подключение к базе данных
     */
    public function __construct()
    {
        try{
            $this->dbc = new PDO("mysql: host = " . APP_DB_HOST . "; dbname = " . APP_DB_DATABASE, APP_DB_USER, APP_DB_PASS);
            $this->dbc->exec("set names utf8");
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}