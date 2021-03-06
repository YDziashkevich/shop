<?php

class View
{
    public static $category = array();
    /**
     * @param $name имя шаблона для вывода
     * @param array $data данные для заполнения шаблона
     */
    public function render($name, $data = array())
    {
        if(!empty($data)){
            extract($data);
        }
        /**
         * массив с списком имени и id категорий
         */
        self::$category = CategoryListModel::getCategoryList();
        if(stristr($name, 'admin')){
            require("inc/views/admin/header.php");
            require('inc/views/'.$name.'.php');
            require("inc/views/admin/footer.php");
        }else{
            require("inc/views/header.php");
            require('inc/views/'.$name.'.php');
            require("inc/views/footer.php");
        }
    }
}