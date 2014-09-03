<?php

Class AdminsModel extends Model{

    public function authValidate($login, $pass){
        $valid = true;
        $errors = array();
        if(empty($login)){
            $errors[] = "Не введен логин";
            $valid = false;
        }
        if(empty($pass)){
            $errors[] = "Не введен пароль";
            $valid = false;
        }
        if($valid){
            return $valid;
        }else{
            return $errors;
        }
    }

    public function checkUser($login, $password){
        $st = self::getDbc()->prepare("SELECT name FROM ".APP_DB_PREFIX."users WHERE isAdmin = 1 AND NAME = :login AND PASSWORD = :password");
        $st->bindValue(":login", $login);
        $st->bindValue(":password", $password);
        $st->execute();
        return $st->fetchColumn();
    }

}