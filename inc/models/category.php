<?php

class CategoryModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function getCategory()
    {
        //self::model();
        $category = self::$dbc->query("SELECT `name` FROM `st_category`");
        $category = $category->fetch(PDO::FETCH_ASSOC);
        var_dump($category);
        return $category;
    }
}