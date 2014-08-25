<?php

Class adminCatalogModel extends Model{
    public $name;
    public $description;
    public $img;
    public $uploadfile;

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
    public function addCategory($name, $description, $uploadfile){
        $st = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."category(name, description, img) VALUES(:name, :description, :img)");
        $st->bindValue(':name', $name);
        $st->bindValue(':description', $description);
        $st->bindValue(':img', $uploadfile);
        return $st->execute();
    }

    /**
     * Проверка была ли отправлена форма
     * @return bool
     */
    public function isPost(){
        return (isset($_POST) && !empty($_POST));
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
        if(isset($this->img)){
            // Задаем директрию для хранения изображений
            $uploadDirectory = 'img/';
            $this->uploadfile = $uploadDirectory.basename($_FILES['img']['name']);

            // Проверяем тип файлов
            $type = $_FILES['img']['type'];
            $validation = false;

            switch($type){
                case 'image/gif':
                case 'image/jpeg':
                case 'image/pjpeg':
                case 'image/png':
                    $validation = true;
                    break;
                default:
                    $errors[] = "Данный тип файла не поддерживается";
                    $valid = false;
                    break;
            }


        }
        $this->errors = $errors;
        if($valid){
            // Если файл прошел проверки, то сохраняем его
            if($validation){
                if(is_uploaded_file($_FILES['img']['tmp_name'])){
                    if(move_uploaded_file($_FILES['img']['tmp_name'],$this->uploadfile)){
                        echo "Файл успешно загружен<br />";
                    }else{
                        echo $_FILES['img']['error'];
                        $this->errors = "Загрузить файл не удалось";
                        return $this->errors;
                    }
                }
            }else{
                if(isset($_FILES['img']['tmp_name'])){
                    $this->errors = "Файл слишком большой или некорректного формата";
                    return $this->errors;
                }
            }

            return $valid;
        }else{
            return $this->errors;
        }
    }

    public function deleteCategory(array $cats_id){
        foreach($cats_id as $cat_id){
            $st = self::getDbc()->prepare("DELETE FROM ".APP_DB_PREFIX."category WHERE id = :id");
            $st->bindValue(':id', $cat_id);
            $r = $st->execute();
        }
        return $r;
    }

    public function getCatsId(){
//        $this->catsId = array();
        $this->catsId = isset($_POST['id']) ? $_POST['id'] : '';
        return $this->catsId;
    }
}