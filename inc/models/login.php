<?php

class LoginModel extends Model
{

    private $formData;

    /**
     * получение данных пользователя для добавления в базу
     */
    private function getFormData()
    {
        $this->formData["name"] = isset($_POST["regName"]) ? trim($_POST["regName"]) : "";
        $this->formData["email"] = isset($_POST["regEmail"]) ? trim($_POST["regEmail"]) : "";
        $this->formData["address"] = isset($_POST["regAddress"]) ? trim($_POST["regAddress"]) : "";
        $this->formData["phone"] = isset($_POST["regPhone"]) ? trim($_POST["regPhone"]) : "";
        $this->formData["paswd"] = isset($_POST["regPaswd"]) ? trim($_POST["regPaswd"]) : "";
        $this->formData["confPaswd"] = isset($_POST["confRegPaswd"]) ? trim($_POST["confRegPaswd"]) : "";
    }

    /**
     * @return array|bool результат валидации данных пользователя
     */
    public function isValid(){
        $this->getFormData();
        $valid = true;
        if(strlen($this->formData["name"]) < 3 && $this->formData["name"] > 16){
            $errors[] = 'Имя короче 3 символов, или больше 16 имволов';
            $valid = false;
        }
        if(!filter_var($this->formData["email"], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Неправильно введен email';
            $valid = false;
        }
        if(!preg_match("/[+] [0-9]{5} [0-9]{3}[-][0-9]{2}[-][0-9]{2}/i",$this->formData["phone"])){
            $errors[] = "Введенный мобильный телефон не соответствует шаблону: + 12345 123-45-67 ";
            $valid = false;
        }
        if(strlen($this->formData["paswd"])<6){
            $errors[] = 'Пароль должен быть больше 6 символов';
            $valid = false;
        }
        if($this->formData["paswd"] != $this->formData["confPaswd"]){
            $errors[] = 'Пароли должны совподать';
            $valid = false;
        }
        if($valid){
            return true;
        }else{
            return $errors;
        }
    }

    /**
     * @return mixed массив с результатами добавления пользователя
     */
    public function saveUser()
    {
        //существует ли такой пользователь
        if($this->getUser($this->formData["name"])){
            $save["validUser"] = false;
        }else{
            $saveUser = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."users (name, email, address, phone, password)
            VALUES (:name, :email, :address, :phone, :password)");
            $save["saveUser"] = $saveUser->execute(array(":name"=>$this->formData["name"], ":email"=>$this->formData["email"],
            ":address"=>$this->formData["address"], ":phone"=>$this->formData["phone"], ":password"=>$this->formData["paswd"]));
        }
        return $save;
    }

    /**
     * @param string $name имя пользователя
     * @return mixed данные о пользователе
     */
    private function getUser($name = "")
    {
        $user = self::getDbc()->prepare("SELECT * FROM ".APP_DB_PREFIX."users WHERE `name`=:name");
        $user->bindParam(":name", $name);
        $user->execute();
        return $user->fetch(PDO::FETCH_ASSOC);
    }
}