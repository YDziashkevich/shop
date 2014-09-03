<?php

class LoginController extends Controller
{
    private $login;
    public function __construct()
    {
        $this->login = new LoginModel();
        parent::__construct();
    }

    /**
     * создание нового пользователя
     */
    public function indexAction()
    {
        $data = array();
        $validate = $this->login->isValid();
        if(!empty($_POST) && isset($_POST["addUser"])){
            if($validate === true){
                $add = $this->login->saveUser();
                if($add["saveUser"]){
                    $_SESSION["user"]["name"] = $_POST["regName"];
                    header('Location:'.APP_BASE_URL);
                    exit();
                }elseif($add["validUser"] === false){
                    $data["errors"][] = "Пользователь с таким именем уже существует";
                }else{
                    $data["errors"][] = "по техническим причинам пользователь не был добавлен, попробуйте снова";
                }
            }else{
                foreach($validate as $valueErrors)
                $data["errors"][] = $valueErrors;
            }
        }

        $this->view->render("login/index",$data);
    }
}