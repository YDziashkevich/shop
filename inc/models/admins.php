<?php

Class AdminsModel extends Model{

    /**
     * Валидация пароля и логина для админки
     * @param $login логин
     * @param $pass пароль
     * @return array|bool массив ошибок или true
     */
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

    /**
     * Поиск админа в бд
     * @param $login логин
     * @param $password пароль
     * @return string логин
     */
    public function checkUser($login, $password){
        $st = self::getDbc()->prepare("SELECT name FROM ".APP_DB_PREFIX."users WHERE isAdmin = 1 AND NAME = :login AND PASSWORD = :password");
        $st->bindValue(":login", $login);
        $st->bindValue(":password", $password);
        $st->execute();
        return $st->fetchColumn();
    }

}