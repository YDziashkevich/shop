<?php

Class StorageModel extends Model{

    /**
     * @return array Возвращает массив сообщений
     */
    public function getStorage(){
        $st = self::getDbc()->prepare('SELECT * FROM '.APP_DB_PREFIX.'messages');
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает размер хранилища(количество строк)
     * @param $storage файл
     * @return int количество строк
     */
    public static function getStorageSize(){
        $size = self::getDbc()->prepare('SELECT id FROM '.APP_DB_PREFIX.'messages');
        $size->execute();
        return $size->rowCount();
    }
}