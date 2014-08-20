<?php

class View
{
    public function __construct()
    {
        $category = new CategoryListModel();
    }
    /**
     * @param $name имя шаблона для вывода
     * @param array $data данные для заполнения шаблона
     */
    public function renderPartial($name, $data = array())
    {
        if(!empty($data)){
            extract($data);
        }

        require("inc/views/header.php");
        require("inc/views/" . $name . ".php");
        require("inc/views/footer.php");
    }

    /**
     * @param $name имя шаблона, который надо отобразить, вида (user/index)
     */
    public function render($name){
        require('inc/views/'.$name.'.php');
    }
}