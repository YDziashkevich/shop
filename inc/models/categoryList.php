<?php

class CategoryListModel extends Model
{
    /**
     * @return array|PDOStatement список категорий с характеристиками
     */
    public static function getCategoryList()
    {
        $category = self::getDbc()->query("SELECT `name`, `id`, `img` FROM `".APP_DB_PREFIX."category`");
        return $category->fetchAll(PDO::FETCH_ASSOC);
    }
}