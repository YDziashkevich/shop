<?php

Class StorageModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    /**
     * @return array Возвращает массив сообщений
     */
    public function getStorage(){
        self::model();
        $st = self::$dbc->prepare('SELECT * FROM '.APP_DB_PREFIX.'messages');
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает размер хранилища(количество строк)
     * @param $storage файл
     * @return int количество строк
     */
    public static function getStorageSize(){
        self::model();
        $size = self::$dbc->prepare('SELECT id FROM '.APP_DB_PREFIX.'messages');
        $size->execute();
        return $size->rowCount();
    }
}