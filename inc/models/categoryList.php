<?php

class CategoryListModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function getCategoryList()
    {
        $categoryList = array();
        $category = self::getDbc()->query("SELECT `name` FROM `st_category`");
        $category = $category->fetchAll(PDO::FETCH_ASSOC);
        foreach($category as $value){
            foreach($value as $name){
                $categoryList[] = $name;
            }
        }
        return $categoryList;
    }
}