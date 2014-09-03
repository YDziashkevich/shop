<?php

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * главная страница
     */
    public function indexAction()
    {
        if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
            //не зарегистрированный пользовател = Гость
            $_SESSION["user"]["name"] = APP_BASE_USER;
            $_SESSION["user"]["id"] = MainModel::getIdUser(APP_BASE_USER);
        }
        if(isset($_SESSION["user"]) && $_SESSION["user"]["name"] != APP_BASE_USER ){
            //зарегистрированный пользователь
            $user = $_SESSION["user"]["name"];
            $_SESSION["user"]["id"] = MainModel::getIdUser($user);
        }
        if(isset($_POST["addBasket"]) && !empty($_POST["addBasket"])){
            $numProducts = MainModel::addBasket($_POST["idProduct"]);
        }
        if($numProducts){
            header('Location: '. APP_BASE_URL . "main/index");
            exit();
        }
        $data["products"] = MainModel::getProducts();
        $this->view->render("main/index", $data);
    }
    /**
     * выход пользователя
     */
    public function exitAction()
    {
        $_SESSION["user"]["name"] = "guest";
        $_SESSION["user"]["id"] = MainModel::getIdUser("guest");
        unset($_SESSION["basket"]);
        unset($_SESSION["summ"]);
        header('Location:'.APP_BASE_URL);
        exit();
    }

    /**
     * вход пользователя
     */
    public function enterAction()
    {
        $validUser = MainModel::validUser();
        if($validUser){
            unset($_SESSION["basket"]);
            unset($_SESSION["summ"]);
            $_SESSION["user"]["name"] = $_POST["loginName"];
            header('Location:'.APP_BASE_URL);
            exit();
        }else{
            $this->indexAction();
        }
    }
}