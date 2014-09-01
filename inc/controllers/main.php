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
            $user = "guest";
            $_SESSION["user"]["name"] = $user;
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
}