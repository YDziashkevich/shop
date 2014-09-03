<?php

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Подлючение модели aдминки(категории)
        $admincatalog = new adminCatalogModel();
        $this->admincatalog = $admincatalog;
        $this->view->admincatalog = $this->admincatalog;

        // Подлючение модели aдминки(товары)
        $adminproducts = new adminProductsModel();
        $this->adminproducts = $adminproducts;
        $this->view->adminproducts = $this->adminproducts;

        // Подлючение модели aдминки(товары)
        $admins = new adminsModel();
        $this->admins = $admins;
        $this->view->admins = $this->admins;
    }

    /**
     * Базовый экшн, открывает шаблон главной страницы
     */
    public function authAction()
    {
        if($this->session->isLoggedIn()){
            $this->redirect(APP_BASE_URL."admin/index");
        }else{
            session_start();
            $this->login = isset($_POST['login']) ? $_POST['login'] : null;
            $this->password = isset($_POST['password']) ? $_POST['password'] : null;

            if(isset($_POST) && !empty($_POST)){
                $validate = $this->admins->authValidate($this->login, $this->password);
                if(!$validate){
                    $this->view->msg = $validate;
                }else{
                    $signIn = $this->admins->checkUser($this->login, $this->password);
                    if($signIn){
                        $_SESSION['login'] = $this->login;
                    }else{
                        $this->view->msg = "Неверно введен логин или пароль";
                    }

                }
            }else{
                $this->view->render("admin/auth");
            }
        }
    }

    /**
     * Базовый экшн, открывает шаблон главной страницы
     */
    public function indexAction()
    {
        $this->view->render("admin/index");
    }

    /**
     * Экшн каталога админки, открывает шаблон каталога
     */
    public function catalogAction()
    {
        // Получение всех категорий
        $this->view->catalog = $this->admincatalog->getCategory();

        $this->view->render("admin/catalog");
    }

    /**
     * Экшн для товаров админки, открывает шаблон товаров
     */
    public function itemsAction()
    {
        // Получение всех категорий
        $this->view->catalog = $this->admincatalog->getCategory();

        // Проверяет была ли отправлена форма
        if(isset($_GET['add'])){

            // Вызов экшна добавления товаров
            $this->items_nextAction();

        }else if(isset($_GET['delete'])){

            // Вызов экшна удаления товаров
            $this->items_deleteAction();

        }else if(isset($_GET['edit'])){

            // Вызов экшна редактирования товаров
            $this->items_editAction();

        }else{
            $this->view->render("admin/items");
        }
    }

    /**
     * Экшн для добавление товаров
     */
    public function items_nextAction(){

        if($this->adminproducts->isGet()){

            $this->cat_id = isset($_GET['cats']) ? $_GET['cats'] : null;
            $this->view->property = $this->adminproducts->getPropertiesProduct($this->cat_id);
            $this->name = isset($_POST['name']) ? $_POST['name'] : '';
            $this->desc = isset($_POST['description']) ? $_POST['description'] : '';
            $this->price = isset($_POST['price']) ? $_POST['price'] : '';
            $this->idCat = isset($_GET['cats']) ? $_GET['cats'] : '';
            $this->value = isset($_POST['value']) ? $_POST['value'] : '';
            $this->img = isset($_POST['img']) ? $_POST['img'] : '';

            if($this->admincatalog->isPost()){
                $validate = $this->adminproducts->isValidProducts();
                if(!$validate){
                    $this->view->msg = $validate;
                }else{
                    $save = $this->adminproducts->saveProduct($this->name, $this->desc, $this->price, $this->idCat, $this->adminproducts->uploadfile);
                    if(!$save){
                        $this->view->errors = "Не удалось сохранить в бд";
                    }else{
                        $this->redirect(APP_BASE_URL."admin/items");
                    }
                }
            }
        }

        $this->view->render("admin/items_next");
    }

    /**
     * Экшн для удаление товаров
     */
    public function items_deleteAction(){

        $this->catId = isset($_GET['cats']) ? $_GET['cats'] : null;

        $this->view->products = $this->adminproducts->getProducts($this->catId);

        if($this->isPost()){
            $idProducts = isset($_POST['id']) ? $_POST['id'] : null;
            $delete = $this->adminproducts->deleteProducts($idProducts);
            if(!$delete){
                $this->msg = "Не удалось удалить товар";
            }else{
                $this->redirect(APP_BASE_URL."admin/items");
            }
        }else{
            $this->view->render("admin/items_delete");
        }
    }

    /**
     * Экшн для редактирование товаров
     */
    public function items_editAction(){
        $this->catId = isset($_GET['cats']) ? $_GET['cats'] : null;

        $this->view->products = $this->adminproducts->getProducts($this->catId);

        if($this->isPost()){
            $this->items_edit_nextAction();

        }else{
            $this->view->render("admin/items_edit");
        }
    }

    public function items_edit_nextAction(){

        $this->catId = isset($_GET['cats']) ? $_GET['cats'] : null;
        $this->view->id = isset($_POST['id']) ? (int) $_POST['id'] : null;
        $this->view->valueProperties = $this->adminproducts->getProductProperties($this->view->id);
        foreach($this->view->valueProperties as $valueProperty){

            $this->view->name = $valueProperty['name'];
            $this->view->description = $valueProperty['description'];
            $this->view->price = $valueProperty['price'];
            $this->view->img = $valueProperty['img'];

        }
        $this->view->id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->name = isset($_POST['name']) ? $_POST['name'] : null;
        $this->description = isset($_POST['description']) ? $_POST['description'] : null;
        $this->price = isset($_POST['price']) ? $_POST['price'] : null;
        $this->img = isset($_POST['img']) ? $_POST['img'] : null;

        if(isset($_POST['submit'])){
            $validate = $this->adminproducts->isValidEditProducts();
            if($validate){
                $alter = $this->adminproducts->alterProduct($this->view->id, $this->name, $this->description, $this->price, $this->catId, $this->adminproducts->uploadfile);
                if(!$alter){
                    $this->msg = "Не удалось отредактировать товар";
                }else{
                    $this->redirect(APP_BASE_URL."admin/items");

                }
            }else{
                $this->view->msg = $validate;
            }
        }else{
            $this->view->render("admin/items_edit_next");
        }
    }
    /**
     * Экшн для свойств товаров
     */
    public function propertiesAction()
    {
        // Получение всех категорий
        $this->view->catalog = $this->admincatalog->getCategory();

        // Проверяет была ли отправлена форма
        if($this->admincatalog->isGet()){

            // Вызывает экшн редактирования категорий
            $this->properties_nextAction();
        }else{
            $this->view->render("admin/properties");
        }

    }

    public function properties_nextAction(){

        $this->view->idCat = isset($_GET['cats']) ? $_GET['cats'] : null;

        $this->view->properties = $this->adminproducts->getProperiesCategory($this->view->idCat);

        $this->view->render("admin/properties_next");

    }

    public function properties_next_addAction(){

        $idCat = isset($_GET['cats']) ? (int)$_GET['cats'] : null;

        $this->view->name = isset($_POST['property']) ? $_POST['property'] : null;
        $this->view->for_input = isset($_POST['for_input']) ? $_POST['for_input'] : null;

        if(isset($_POST['submit'])){
            $val = $this->adminproducts->validateNewProperty();
            if(!$val){
                $this->view->msg = $val;
            }else{
                $add = $this->adminproducts->addProperty($this->view->name, $idCat, $this->view->for_input);
                if(!$add){
                    $this->view->msg = "Не удалось добавить свойство";
                }else{
                    $this->redirect(APP_BASE_URL."admin/properties");
                }
            }

        }else{
            $this->view->render("admin/properties_next_add");
        }


    }

    public function properties_next_deleteAction(){

        $idCat = isset($_GET['cats']) ? (int)$_GET['cats'] : null;
        $this->view->properties = $this->adminproducts->getProperiesCategory($idCat);

        $ids = isset($_POST['id']) ? $_POST['id'] : null;

        if(isset($_POST['submit'])){
            foreach($ids as $id){
                $delete = $this->adminproducts->deleteProperty($id);
            }
            if(!$delete){
                $this->view->msg = "Не удалось удалить свойство";
            }else{
                $this->redirect(APP_BASE_URL."admin/properties");
            }
        }else{
            $this->view->render("admin/properties_next_delete");
        }

    }

    public function properties_next_editAction(){

        $this->view->catId = isset($_GET['cats']) ? (int)$_GET['cats'] : null;
        $this->view->properties = $this->adminproducts->getProperiesCategory($this->view->catId);

        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if(isset($_GET['edit'])){
            $this->redirect(APP_BASE_URL."admin/properties_next_edit_next?id=".$id."&idCat=".$this->view->catId);
        }else{
            $this->view->render("admin/properties_next_edit");
        }

    }

    public function properties_next_edit_nextAction(){

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $idCat = isset($_GET['idCat']) ? $_GET['idCat'] : null;
        $property = isset($_POST['property']) ? $_POST['property'] : null;
        $for_input = isset($_POST['for_input']) ? $_POST['for_input'] : null;

        if(isset($_POST['submit'])){
            $val = $this->adminproducts->validateNewProperty();
            if(!$val){
                $this->view->msg = $val;
            }else{
                $edit = $this->adminproducts->editProperty($id, $property, $idCat, $for_input);
                if(!$edit){
                    $this->view->msg = "Не удалось отредактировать свойство";
                }else{
                    $this->redirect(APP_BASE_URL."admin/properties");
                }
            }
        }else{
            $this->view->render("admin/properties_next_edit_next");
        }

    }

    /**
     * Экшн для редактирования прав доступа
     */
    public function securityAction()
    {
        $this->view->render("admin/security");
    }

    /**
     * Экшн для добавления новой категории
     */
    public function catalog_addAction()
    {
        $this->view->msg = '';

        // Получение данных из формы
        $this->admincatalog->getData();

        $this->view->name = $this->admincatalog->name;
        $this->view->description = $this->admincatalog->description;

        // Проверяет бы ли отправлена форма
        if($this->admincatalog->isPost()){

            // Валидация формы, если прошла то добавляет новую категорию в бд, иначе выводит сообщение об ошибке
            $validate = $this->admincatalog->isValid();

            if($validate !== true){

                // Получение всех ошибок
                $errors = implode('<br />', $validate);
                $this->view->msg = $errors;

            }else{

                // Добавление новой категории
                $save = $this->admincatalog->addCategory($this->admincatalog->name, $this->admincatalog->description, $this->admincatalog->uploadfile);

                if(!$save){
                    $this->view->msg = 'Не удалось сохранить';
                }else{
                    $this->redirect(APP_BASE_URL."admin/catalog");
                }
            }
        }

        $this->view->render("admin/catalog_add");
    }

    /**
     * Экшн для удаления категории
     */
    public function catalog_deleteAction(){

        // Получение списка всех категорий
        $this->view->catalog = $this->admincatalog->getCategory();

        // Проверяет была ли отправлена форма
        if($this->admincatalog->isPost()){

            // Получение ид выбранных категорий
            $this->admincatalog->getCatsId();

            // Удаление категорий
            $this->admincatalog->deleteCategory($this->admincatalog->catsId);
            $this->redirect("catalog_delete");
            die;
        }

        $this->view->render("admin/catalog_delete");
    }

    /**
     * Экшн для выбора редактируемой категории
     */
    public function catalog_editAction(){

        // Получение всех категорий
        $this->view->catalog = $this->admincatalog->getCategory();

        // Проверяет была ли отправлена форма
        if($this->admincatalog->isGet()){

            // Вызывает экшн редактирования категорий
            $this->catalog_edit_nextAction();
        }else{
            $this->view->render("admin/catalog_edit");
        }
    }

    /**
     * Экшн для редактирования категорий
     */
    public function catalog_edit_nextAction(){

        // Проверяет есть ли данные в методе GET
        if($this->admincatalog->isGet()){

            // Получение ид выбранной категории
            $this->id = isset($_GET['cats']) ? $_GET['cats'] : '';

            // Получение свойств выбранной категории
            $propertyCategory = $this->admincatalog->getOneCategory($this->id);

            // Получение данных для представления
            $this->view->id = isset($_POST['id']) ? $_POST['id'] : $propertyCategory['id'];
            $this->view->name = isset($_POST['name']) ? $_POST['name'] : $propertyCategory['name'];
            $this->view->description = isset($_POST['description']) ? $_POST['description'] : $propertyCategory['description'];

            // Получение данных из формы
            $this->admincatalog->getData();

            // Проверяет была ли отправлена форма
            if($this->admincatalog->isPost()){

                // Валидация данных
                $validate = $this->admincatalog->isValid2();

                // Вывод ошибок, если не прошла валидация, и сохранение данных, если все хорошо
                if($validate !== true){

                    $errors = implode('<br />', $validate);
                    $this->view->msg = $errors;

                }else{

                    // Если файл для загрузки не менялся, то выполняется первый скрипт, иначе второй
                    if(!isset($this->admincatalog->uploadfile)){

                        $save = $this->admincatalog->editCategory($this->view->id, $this->admincatalog->name, $this->admincatalog->description);

                    }else{

                        $save = $this->admincatalog->editCategory($this->view->id, $this->admincatalog->name, $this->admincatalog->description, $this->admincatalog->uploadfile);

                    }

                    // Проверка выполнилось сохранение или нет
                    if(!$save){

                        $this->view->msg = 'Не удалось сохранить';

                    }else{

                        $this->redirect(APP_BASE_URL."admin/catalog");
                    }
                }
            }
        }
        $this->view->render("admin/catalog_edit_next");
    }

    /**
     * Проверка была ли отправлена форма POST
     * @return bool
     */
    public function isPost(){
        return (isset($_POST) && !empty($_POST));
    }

}
