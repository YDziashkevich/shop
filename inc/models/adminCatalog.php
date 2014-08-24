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
            $uploadDirectory = APP_BASE_URL.'images/';
            $uploadfile = $uploadDirectory.basename($_FILES['img']['name']);

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
                    break;
            }
        }
        $this->errors = $errors;
        if($valid){
            // Если файл прошел проверки, то сохраняем его
            if($validation){
                if(is_uploaded_file($_FILES['img']['tmp_name'])){
                    if(move_uploaded_file($_FILES['img']['tmp_name'],$uploadfile)){
//                        echo "Файл успешно загружен<br />";
                    }else{
                        $errors[] = "Загрузить файл не удалось";
                    }
                }
            }else{
                if(isset($_FILES['img']['tmp_name'])){
                    $errors[] = "Файл слишком большой или некорректного формата";
                }
            }
            return $valid;
        }else{
            return $this->errors;
        }
    }
}