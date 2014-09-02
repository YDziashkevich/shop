<?php

Class adminProductsModel extends Model{

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
    public function isValidProducts(){
        $valid = true;
        $this->errors = array();

        // Валидация остальных полей

        // Валидация картинки
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
     * Валидация полей при редактировании товаров
     * @return array|bool|string
     */
    public function isValidEditProducts(){
        $valid = true;
        $this->errors = array();

        // Валидация остальных полей

        // Валидация картинки

        // Задаем директрию для хранения изображений
        $uploadDirectory = 'img/';
        $this->uploadfile = $uploadDirectory.basename($_FILES['img']['name']);

        if(isset($_FILES['img']['name'])){
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
     * Редактирование товара в бд
     * @return bool true - товар отредактирован, иначе false
     */
    public function alterProduct($id, $name, $description, $price, $idCategory, $img){
        echo 1;
        // Редактирование товара в таблице products название, описание, цену и картинку
        $st = self::getDbc()->prepare("UPDATE ".APP_DB_PREFIX."products
                                      SET name = :name, description = :description, price = :price, img = :img
                                      WHERE id = :id");
        $st->bindValue(":name", $name);
        $st->bindValue(":description", $description);
        $st->bindValue(":price", $price, PDO::PARAM_INT);
        $st->bindValue(":img", $img);
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        $st->execute();

        // Получение информации о требуемых полях
        $st = self::getDbc()->prepare("SELECT id, for_input FROM ".APP_DB_PREFIX."properties WHERE idCategory = :idCategory");
        $st->bindValue(":idCategory", $idCategory, PDO::PARAM_INT);
        $st->execute();
        $properties = $st->fetchAll(PDO::FETCH_ASSOC);

        // Запись в таблицу product2property значений
        foreach($properties as $property){
            $value = isset($_POST[$property['for_input']]) ? $_POST[$property['for_input']] : null;
            $st = self::getDbc()->prepare("UPDATE ".APP_DB_PREFIX."product2property
                                          SET VALUE = :value
                                          WHERE idProduct = :idProduct AND idProperty = :idProperty");
            $st->bindValue(":idProduct", $id, PDO::PARAM_INT);
            $st->bindValue(":idProperty", $property['id'], PDO::PARAM_INT);
            $st->bindValue(":value", $value);
            $r = $st->execute();
            $st->execute();
        }
        return $r;
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
     * Получения всех товаров для категории
     * @param $catId ид категории
     * @return array массив товаром со свойствами
     */
    public function getProducts($catId){
        $st = self::getDbc()->prepare("SELECT id, name, description, price FROM ".APP_DB_PREFIX."products WHERE idCategory = :catId");
        $st->bindValue(":catId", $catId);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Удаление товара из бд
     * @param array $idProducts ид товаров
     * @return bool true - удаление выполнено, иначе false
     */
    public function deleteProducts(array $idProducts){
        foreach($idProducts as $id){
            $st = self::getDbc()->prepare("DELETE FROM ".APP_DB_PREFIX."products WHERE id = :id");
            $st->bindValue(':id', $id);
            $r = $st->execute();
        }
        return $r;
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
     * Получение свойств для выбранного товара
     * @param $id ид продукта
     * @return array массив данных
     */
    public function getProductProperties($id){
        $st = self::getDbc()->prepare("SELECT ".APP_DB_PREFIX."products.id, name, description, price, img, value, property, for_input, ".APP_DB_PREFIX."properties.id AS id_property FROM ".APP_DB_PREFIX."products
                                       JOIN ".APP_DB_PREFIX."product2property
                                       ON ".APP_DB_PREFIX."product2property.idProduct = ".APP_DB_PREFIX."products.id
                                       JOIN ".APP_DB_PREFIX."properties
                                       ON ".APP_DB_PREFIX."properties.id = ".APP_DB_PREFIX."product2property.idProperty
                                       WHERE ".APP_DB_PREFIX."products.id = :id");
        $st->bindValue(":id", $id);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProperiesCategory($idCat){
        $st = self::getDbc()->prepare("SELECT id, property FROM ".APP_DB_PREFIX."properties WHERE idCategory = :idCat");
        $st->bindValue(":idCat", $idCat);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProperty($name, $catId, $for_input){
        $st = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."properties(property,idCategory,for_input) VALUES(:name,:catId,:for_input)");
        $st->bindValue(":name", $name);
        $st->bindValue(":catId", $catId, PDO::PARAM_INT);
        $st->bindValue(":for_input", $for_input);
        $r = $st->execute();
        if(!$r){
            var_dump($st->errorInfo());
        }
        return $r;
    }

    public function validateNewProperty(){
        return true;
    }

    public function deleteProperty($id){
        $st = self::getDbc()->prepare("DELETE FROM ".APP_DB_PREFIX."properties WHERE id = :id");
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        return $st->execute();
    }

    public function editProperty($id, $property, $catId, $for_input){
        $st = self::getDbc()->prepare("UPDATE ".APP_DB_PREFIX."properties SET property = :property, idCategory = :catId, for_input = :for_input WHERE id = :id");
        $st->bindValue(":id", $id);
        $st->bindValue(":property", $property);
        $st->bindValue(":catId", $catId, PDO::PARAM_INT);
        $st->bindValue(":for_input", $for_input);
        $r = $st->execute();
        if(!$r){
            var_dump($st->errorInfo());
        }
        return $r;
    }
}