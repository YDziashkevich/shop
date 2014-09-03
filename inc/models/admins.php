<?php

Class AdminsModel extends Model{

    public function authValidate($login, $pass){
        $valid = true;
        $errors = array();
        if(strlen($login) < 5){
            $errors = "Логин короче 5 символов";
            $valid = false;
        }
        if(strlen($pass) < 5){
            $errors = "Логин короче 5 символов";
            $valid = false;
        }
        if($valid){
            return $valid;
        }else{
            return $errors;
        }
    }

    public function checkUser($login, $password){
        $st = self::getDbc()->prepare("SELECT * FROM ".APP_DB_PREFIX."users WHERE isAdmin = 1 AND NAME = :login AND PASSWORD = :password");
        $st->bindValue(":login", $login);
        $st->bindValue(":password", $password);
        return $st->execute();
    }

}