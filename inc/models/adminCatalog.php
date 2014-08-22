<?php

Class adminCatalogModel extends Model{
    public $name;
    public $description;
    public $img;

    /**
     * Получить массив всех категорий
     * @return array
     */
    public function getCategory(){
        $st = self::getDbc()->query("SELECT * FROM ".APP_DB_PREFIX."category`");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Добавление новой категории
     * @param $name название
     * @param $description описание
     * @param $img путь к картинке
     * @return bool true - добавлена категория, иначе false
     */
    public function addCategory($name, $description, $img = ''){
        $st = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."category(name, description, img) VALUES(:name, :description, :img)");
        $st->bindValue(':name', $name);
        $st->bindValue(':description', $description);
        $st->bindValue(':img', $img);
        return $st->execute();
    }

    /**
     * Проверка была ли отправлена форма
     * @return bool
     */
    public function isAdd(){
        return isset($_POST['add']);
    }

    /**
     * Проверка была ли отправлена форма
     * @return bool
     */
    public function isSubmit(){
        return isset($_POST['submit']);
    }

    /**
     * Получение данных из формы
     * @return bool
     */
    public function getData(){
        $this->name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $this->description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $this->img = isset($_POST['img']) ? $_POST['img'] : '';
        return true;
    }

    /**
     * Валидация формы
     * @return array|bool возвращает true или список ошибок
     */
    public function isValid(){
        $valid = true;
        $this->errors = array();
        if(strlen($this->name) < 5){
            $errors[] = "Название короче 5 символов";
            $valid = false;
        }
        if(strlen($this->description) < 15){
            $errors[] = "Название короче 15 символов";
            $valid = false;
        }
//        if(валидация изображения){
//
//        }
        $this->errors = $errors;
        if($valid){
            return $valid;
        }else{
            return $this->errors;
        }
    }
}