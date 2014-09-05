<?php

Class adminCatalogModel extends Model{
    public $name;
    public $description;
    public $img;
    public $uploadfile;
    public $folder;

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
    public function editCategory($id, $name, $description, $folder, $img = ''){
        if($img == ''){
            // Новое изображение не добавляется
            $st = self::getDbc()->prepare("UPDATE ".APP_DB_PREFIX."category SET name = :name, description = :description, folder = :folder WHERE id = :id");
        }else{
            // Добавляется новое изображение
            $st = self::getDbc()->prepare("UPDATE ".APP_DB_PREFIX."category SET name = :name, description = :description, , folder = :folder, img = :img WHERE id = :id");
            $st->bindValue(':img', $img);
        }
        $st->bindValue(':id', $id);
        $st->bindValue(':name', $name);
        $st->bindValue(':description', $description);
        $st->bindValue(':folder', $folder);
        return $st->execute();
    }

    /**
     * Добавление новой категории
     * @param $name название
     * @param $description описание
     * @param $img путь к картинке
     * @return bool true - добавлена категория, иначе false
     */
    public function addCategory($name, $description, $uploadfile, $folder){
        $st = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."category(name, description, img, folder) VALUES(:name, :description, :img, :folder)");
        $st->bindValue(':name', $name);
        $st->bindValue(':description', $description);
        $st->bindValue(':img', $uploadfile);
        $st->bindValue(':folder', $folder);
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
        $this->folder = isset($_POST['folder']) ? $_POST['folder'] : null;
        return $this;
    }

    /**
     * Валидация формы
     * @return array|bool возвращает true или список ошибок
     */
    public function isValid($folder){
        $valid = true;
        $errors = array();

        // Валидация названия
        if(strlen($this->name) < 5){
            $errors['name'] = "Название короче 5 символов";
            $valid = false;
        }

        // Валидация описания
        if(strlen($this->description) < 15){
            $errors['description'] = "Название короче 15 символов";
            $valid = false;
        }

        // Валидация названия папок
        if(strlen($folder) < 2){
            $errors['folder'] = "Название папки короче 2 символов";
            $valid = false;
        }

        // Валидация картинки

        if($_FILES['img']['name']){
            // Задаем директрию для хранения изображений
            mkdir('images/product/'.$folder.'/');
            $uploadDirectory = 'images/product/'.$folder.'/';
            $key = microtime($get_as_float = true);
            $this->uploadfile = $uploadDirectory.$key.basename($_FILES['img']['name']);

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
                    $errors['img'] = "Данный тип файла не поддерживается";
                    $valid = false;
                    break;
            }
        }else{
            $errors['img'] = "Не выбрано загружено изображение";
        }

        if($valid){
            // Если файл прошел проверки, то сохраняем его
            if($validation){
                if(is_uploaded_file($_FILES['img']['tmp_name'])){
                    if(move_uploaded_file($_FILES['img']['tmp_name'],$this->uploadfile)){
                        echo "Файл успешно загружен<br />";
                    }else{
                        echo $_FILES['img']['error'];
                        $errors['img'] = "Загрузить файл не удалось";
                        return $this->errors;
                    }
                }
            }else{
                if(isset($_FILES['img']['tmp_name'])){
                    $errors['img'] = "Файл слишком большой или некорректного формата";
                    return $this->errors;
                }
            }

            return $valid;
        }else{
            return $errors;
        }
    }

    /**
     * Валидация формы при редактировании категории
     * @return array|bool возвращает true или список ошибок
     */
    public function isValid2($folder){
        $valid = true;
        $errors = array();

        // Валидация названия
        if(strlen($this->name) < 5){
            $errors['name'] = "Название короче 5 символов";
            $valid = false;
        }

        // Валидация описания
        if(strlen($this->description) < 15){
            $errors['desc'] = "Название короче 15 символов";
            $valid = false;
        }

        // Валидация названия папок
        if(strlen($folder) < 2){
            $errors['folder'] = "Название папки короче 2 символов";
            $valid = false;
        }

        // Задаем директрию для хранения изображений
        mkdir('images/product/'.$folder.'/');
        $uploadDirectory = 'images/product/'.$folder.'/';
        $key = microtime($get_as_float = true);
        $this->uploadfile = $uploadDirectory.$key.basename($_FILES['img']['name']);

        if($_FILES['img']['name']){
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
                    $errors['img'] = "Данный тип файла не поддерживается";
                    $valid = false;
                    break;
            }
        }
        if($valid){
            if(isset($this->img)){
                // Если файл прошел проверки, то сохраняем его
                if($validation){echo 1;
                    if(is_uploaded_file($_FILES['img']['tmp_name'])){
                        if(move_uploaded_file($_FILES['img']['tmp_name'],$this->uploadfile)){
                            echo "Файл успешно загружен<br />";
                        }else{
                            $errors['img'] = "Загрузить файл не удалось";
                            $valid = false;
                        }
                    }
                }else{
                    if(isset($_FILES['img']['tmp_name'])){
                        $errors['img'] = "Файл слишком большой или некорректного формата";
                        $valid = false;
                    }
                }
            }
            if($valid){
                return $valid;
            }else{
                return $errors;
            }
        }else{
            return $errors;
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

    /**
     * Получение детальных полей товаров для категории
     * @param $cat_id ид категории
     * @return mixed массив полей товаров
     */
    public function getPropertiesProduct($cat_id){
        $st = self::getDbc()->prepare("SELECT * FROM ".APP_DB_PREFIX."properties WHERE idCategory = :cat_id");
        $st->bindValue(":cat_id", $cat_id);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Валидация полей добавления товаров
     * @return array|bool|string
     */
    public function isValidProducts($idCat){
        $valid = true;
        $errors = array();

        // Валидация остальных полей

        // Валидация картинки
        // Задаем директрию для хранения изображений
        $uploadDirectory = 'images/product/'.$this->folder.'/';
        $key = microtime($get_as_float = true);
        $this->uploadfile = $uploadDirectory.$key.basename($_FILES['img']['name']);

        if($_FILES['img']['name']){
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
                    $errors['img'] = "Данный тип файла не поддерживается";
                    $valid = false;
                    break;
            }
        }
        if($valid){
            // Если файл прошел проверки, то сохраняем его
            if($validation){
                if(is_uploaded_file($_FILES['img']['tmp_name'])){
                    if(move_uploaded_file($_FILES['img']['tmp_name'],$this->uploadfile)){
                        echo "Файл успешно загружен<br />";
                    }else{
                        echo $_FILES['img']['error'];
                        $errors['img'] = "Загрузить файл не удалось";
                    }
                }
            }else{
                if(isset($_FILES['img']['tmp_name'])){
                    $errors['img'] = "Файл слишком большой или некорректного формата";
                }
            }

            return $valid;
        }else{
            return $errors;
        }
    }

    /**
     * Сохранение в бд нового товара
     * @return bool true - сохранен, иначе false
     */
    public function saveProduct($name, $description, $price, $idCategory, $img){

        // Запись в таблицу products название, описание, цену и картинку
        $st = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."products(name, description, price, idCategory, img) VALUES(:name, :description, :price, :idCategory, :img)");
        $st->bindValue(":name", $name);
        $st->bindValue(":description", $description);
        $st->bindValue(":price", $price, PDO::PARAM_INT);
        $st->bindValue(":idCategory", $idCategory, PDO::PARAM_INT);
        $st->bindValue(":img", $img);
        $st->execute();

        // Получение последнего вставленного ид
        $lastId = (int) self::getDbc()->lastInsertId();

        // Получение информации о требуемых полях
        $st = self::getDbc()->prepare("SELECT id, for_input FROM ".APP_DB_PREFIX."properties WHERE idCategory = :idCategory");
        $st->bindValue(":idCategory", $idCategory, PDO::PARAM_INT);
        $st->execute();
        $properties = $st->fetchAll(PDO::FETCH_ASSOC);

        // Запись в таблицу product2property значений
        foreach($properties as $property){
            $value = isset($_POST[$property['for_input']]) ? $_POST[$property['for_input']] : null;
            $st = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."product2property(idProduct,idProperty,value) VALUES(:lastId, :idProperty, :value)");
            $st->bindValue(":lastId", $lastId, PDO::PARAM_INT);
            $st->bindValue(":idProperty", $property['id'], PDO::PARAM_INT);
            $st->bindValue(":value", $value);
            $r = $st->execute();

        }
        return $r;
    }

    /**
     * Получение названия папки категории
     * @param $id ид категории
     * @return string название папки
     */
    public function getFolder($id){
        $st = self::getDbc()->prepare("SELECT folder FROM ".APP_DB_PREFIX."category` WHERE id = :id");
        $st->bindValue(":id", $id);
        $st->execute();
        return $st->fetchColumn();
    }
}