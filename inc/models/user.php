<?php

class UserModel extends Model
{
    /**
     * @param string $idUser id пользователя
     * @return array массив с спиком заказов
     */
    public function getOrders($idUser = "")
    {
        $orders = self::getDbc()->prepare("SELECT id, date FROM ".APP_DB_PREFIX."orders WHERE idUser=:idUser");
        $orders->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $orders->execute();
        return $orders->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param string $id id заказа
     * @return array массив с товарами заказа
     */
    public function getOrder($id = "")
    {
        $order = self::getDbc()->prepare("SELECT  ".APP_DB_PREFIX."orders.`id`, ".APP_DB_PREFIX."orders.`date`,
        ".APP_DB_PREFIX."items.`idProduct`, ".APP_DB_PREFIX."items.`numProduct`, ".APP_DB_PREFIX."products.`name` AS nameProduct,
        ".APP_DB_PREFIX."products.`price`
        FROM ".APP_DB_PREFIX."orders INNER JOIN ".APP_DB_PREFIX."items INNER JOIN ".APP_DB_PREFIX."products WHERE
        ".APP_DB_PREFIX."orders.`id`=".APP_DB_PREFIX."items.`idOrder` AND ".APP_DB_PREFIX."items.`idProduct`=
        ".APP_DB_PREFIX."products.`id` AND ".APP_DB_PREFIX."orders.`id`=:id");
        $order->bindParam(":id", $id, PDO::PARAM_INT);
        $order->execute();
        return $order->fetchAll(PDO::FETCH_ASSOC);
    }
}