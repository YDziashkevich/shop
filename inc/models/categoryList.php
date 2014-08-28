<?php

class CategoryListModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function getCategoryList()
    {
        $category = self::getDbc()->query("SELECT `name`, `id`, `img` FROM `st_category`");
        $category = $category->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }
}