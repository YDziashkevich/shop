<?php

class MainModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function getProducts()
    {
        $products = self::getDbc()->query("SELECT * FROM st_products");
        return $products->fetchAll(PDO::FETCH_ASSOC);
    }
}