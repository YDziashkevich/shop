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
        $st = self::getDbc()->query("SELECT * FROM ".APP_DB_PREFIX."category");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получение данных для одной категории
     * @param $id ид категории
     * @return mixed возвращает массив данных
     */
    public function getOneCategory($id){
        $st = self::getDbc()->prepare("SELECT * FROM ".APP_DB_PREFIX."category WHERE id = :id");
        $st->bindValue(':id', $id);
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Редактирование полей категории
     * @param $id ид категории
     * @param $name название категории
     * @param $description описание категории
     * @param string $img адрес картинки
     * @return bool true - выполнилось изменение, иначе false
     */
    public function editCategory($id, $name, $description, $img = ''){
        if($img == ''){

            // Новое изображение не добавляется
            $st = self::getDbc()->prepare("UPDATE ".APP_DB_PREFIX."category SET name = :name, description = :description WHERE id = :id");
            $st->bindValue(':id', $id);
            $st->bindValue(':name', $name);
            $st->bindValue(':description', $description);
            return $st->execute();
        }else{

            // Добавляется новое изображение
            $st = self::getDbc()->prepare("UPDATE ".APP_DB_PREFIX."category SET name = :name, description = :description, img = :img WHERE id = :id");
            $st->bindValue(':id', $id);
            $st->bindValue(':name', $name);
            $st->bindValue(':description', $description);
            $st->bindValue(':img', $img);
            return $st->execute();
        }

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
     * Проверка была ли отправлена форма POST
     * @return bool
     */
    public function isPost(){
        return (isset($_POST) && !empty($_POST));
    }

    /**
     * Проверяет была ли отправлена форма методом GET
     * @return bool
     */
    public function isGet(){
        return isset($_GET['cats']);
    }

    /**
     * Получение данных из формы
     * @return bool
     */
    public function getData(){
        $this->name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $this->description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $this->img = isset($_POST['img']) ? $_POST['img'] : null;
        return true;
    }

    /**
     * Валидация формы
     * @return array|bool возвращает true или список ошибок
     */
    public function isValid(){
        $valid = true;
        $this->errors = array();

        // Валидация названия
        if(strlen($this->name) < 5){
            $errors[] = "Название короче 5 символов";
            $valid = false;
        }

        // Валидация описания
        if(strlen($this->description) < 15){
            $errors[] = "Название короче 15 символов";
            $valid = false;
        }

        // Валидация картинки
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

    /**
     * Валидация формы
     * @return array|bool возвращает true или список ошибок
     */
    public function isValid2(){
        $valid = true;
        $this->errors = array();

        // Валидация названия
        if(strlen($this->name) < 5){
            $errors[] = "Название короче 5 символов";
            $valid = false;
        }

        // Валидация описания
        if(strlen($this->description) < 15){
            $errors[] = "Название короче 15 символов";
            $valid = false;
        }

        // Задаем директрию для хранения изображений
        $uploadDirectory = 'img/';
        $this->uploadfile = $uploadDirectory.basename($_FILES['img']['name']);

        if($this->uploadfile !== $uploadDirectory){
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
            if(!empty($this->img)){
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
            }
            return $valid;
        }else{
            return $this->errors;
        }
    }

    /**
     * Удаление категории из бд
     * @param array $cats_id ид категорий
     * @return bool true - удаление выполнено, иначе false
     */
    public function deleteCategory(array $cats_id){
        foreach($cats_id as $cat_id){
            $st = self::getDbc()->prepare("DELETE FROM ".APP_DB_PREFIX."category WHERE id = :id");
            $st->bindValue(':id', $cat_id);
            $r = $st->execute();
        }
        return $r;
    }

    /**
     * Получение ид категории
     * @return string
     */
    public function getCatsId(){
        $this->catsId = isset($_POST['id']) ? $_POST['id'] : '';
        return $this->catsId;
    }


}