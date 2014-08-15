<?php

class View
{
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
}