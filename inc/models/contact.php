<?php

Class ContactModel extends Model{
    public $name;
    public $email;
    public $topic;
    public $message;
    public $captcha;
    public static $question;

    public  $errors;

    public function __construct(){
        parent::__construct();
    }

    /**
     * Получение данных из формы
     * @return bool
     */
    public function getData(){
        $this->name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $this->email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $this->topic = isset($_POST['topic']) ? trim($_POST['topic']) : '';
        $this->message = isset($_POST['message']) ? trim($_POST['message']) : '';
        $this->captcha = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';
        return true;
    }

    /**
     * Генерация капчи, возвращает ответ и визуальное представление
     * @return mixed array
     */
    public static function generateCapcha(){
        $a = rand(10, 20);
        $b = rand(10, 20);
        if($a < $b){
            $tmp_a = $b;
            $b = $a;
            $a = $tmp_a;
        }
        $z = rand(0, 1);
        if($z == 0){
            $rezult[] = $a.'+'.$b;
            $rezult[] = $a+$b;
        }else{
            $rezult[] = $a.'-'.$b;
            $rezult[] = $a-$b;
        }


        $_SESSION['captcha'] = $rezult[1];
        self::$question = $rezult[0];
        return $rezult[0];
    }

    /**
     * Проверяет правильность введенной капчи
     * @return bool
     */
    public function checkCaptchaAnswer($answ){
        $rightAnsw = isset($_SESSION['captcha'])? $_SESSION['captcha']: '';
        return $answ == $rightAnsw;
    }

    /**
     * Проверка валидности данных
     * @return array|bool Возвращает true, если данные валидны, иначе выводит массив ошибок
     */
    public function isValid(){
        $valid = true;
        $this->errors = array();
        $errors = array();
        if(strlen($this->name) < 3){
            $errors[] = 'Имя короче 3 символов';
            $valid = false;
        }
        if(strlen($this->topic) < 5){
            $errors[] = 'Тема короче 5 символов';
            $valid = false;
        }
        if(strlen($this->message) < 20){
            $errors[] = 'Сообщение короче 20 символов';
            $valid = false;
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Неправильно введен email';
            $valid = false;
        }
        if(!$this->checkCaptchaAnswer($this->captcha)){
            $errors[] = 'Неправильно введена капча';
            $valid = false;
        }
        $this->errors = $errors;
        if($valid){
            return true;
        }else{
            return $this->errors;
        }
    }

    /**
     * Проверка, была ли отправлена форма
     * @return bool
     */
    public function isPost(){
        return (isset($_POST['submit']) and !empty($_POST));
    }

    /**
     * Получение сообщений об ошибках
     * @return string
     */
    public function getErrors(){
        $msgErrors = implode('<br />', $this->errors);
        return $msgErrors;
    }

    /**
     * Сохранение данных в бд
     * @param $name
     * @param $email
     * @param $message
     * @param $topic
     */
    public function save($name, $email,$topic, $message){
        $st = self::getDbc()->prepare("INSERT INTO ".APP_DB_PREFIX."contacts(name, email,topic, message) VALUES(:name, :email,:topic, :message)");
        $st->bindValue(':name', $name);
        $st->bindValue(':email', $email);
        $st->bindValue(':topic', $topic);
        $st->bindValue(':message', $message);
        $r = $st->execute();
        if(!$r){
            var_dump($st->errorInfo());
            var_dump($st->queryString);
        }
        return $r;
    }
}