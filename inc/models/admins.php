<?php

Class AdminsModel extends Model{

    public static function dataAdmin(){
        $admins = array(
            array('login' => 'admin', 'password' => 'password')
        );
        return $admins;
    }

    public function validate($login, $pass){
        return true;
    }


}