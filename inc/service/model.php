<?php

class Model
{
    protected static $dbc;
    protected static $instance;

    public function __construct(){
        if(!self::$dbc){
            self::$dbc = new PDO("mysql: host=".APP_DB_HOST."; dbname=".APP_DB_DATABASE, APP_DB_USER, APP_DB_PASS);
        }
    }

    public static function model(){
        if(!self::$instance){
            self::$instance = new self;
        }
    }

    public static function query($query){
        self::model();
        return self::$dbc->query($query);
    }

    public static function prepare($query){
        self::model();
        return self::$dbc->prepare($query);
    }

    private function __clone(){}

    private function __wakeup(){}
}