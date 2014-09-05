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

        // Подлючение модели aдминки(товары)
        $session = new sessionModel();
        $this->session = $session;
        $this->view->session = $this->session;
    }

    /**
     * Экшн для выхода залогированного администратора
     */
    public function logoutAction(){
        $this->session->logout();
        $this->redirect(APP_BASE_URL."admin/index");
    }

    /**
     * Базовый экшн, открывает шаблон главной страницы
     */
    public function authAction()
    {
        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $this->redirect(APP_BASE_URL."admin/index");
        }else{
            session_start();

            // Получение данных из формы
            $this->login = isset($_POST['login']) ? htmlspecialchars(strip_tags(trim($_POST['login']))) : null;
            $this->password = isset($_POST['password']) ? htmlspecialchars(strip_tags(trim($_POST['password']))) : null;

            if(isset($_POST) && !empty($_POST)){

                // Проверка заполнены ли поля логина и пароля
                $validate = $this->admins->authValidate($this->login, $this->password);

                if($validate !== true){
                    // Вывод сообщений об ошибках
                    $this->view->msg = $validate;
                }else{

                    // Поиск пользователя в базе
                    $signIn = $this->admins->checkUser($this->login, $this->password);

                    if($signIn){
                        $_SESSION['login'] = $this->login;
                        $this->redirect(APP_BASE_URL."admin/index");
                    }else{
                        $this->view->msg = "Неверно введен логин или пароль";
                    }
                }
            }
            $this->view->render("admin/auth");
        }
    }

    /**
     * Базовый экшн, открывает шаблон главной страницы
     */
    public function indexAction()
    {
        if($this->session->isLoggedIn()){
            $this->view->render("admin/index");
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн каталога админки, открывает шаблон каталога
     */
    public function catalogAction()
    {

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            // Получение всех категорий
            $this->view->catalog = $this->admincatalog->getCategory();

            $this->view->render("admin/catalog");
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для товаров админки, открывает шаблон товаров
     */
    public function itemsAction()
    {

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            // Получение всех категорий
            $this->view->catalog = $this->admincatalog->getCategory();

            $idCat = isset($_GET['cats']) ? htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;
            // Проверяет была ли отправлена форма
            if(isset($_GET['add'])){

                // Вызов экшна добавления товаров
                $this->redirect(APP_BASE_URL."admin/items_next?cats=".$idCat);

            }else if(isset($_GET['delete'])){

                // Вызов экшна удаления товаров
                $this->redirect(APP_BASE_URL."admin/items_delete?cats=".$idCat);

            }else if(isset($_GET['edit'])){

                // Вызов экшна редактирования товаров
                $this->redirect(APP_BASE_URL."admin/items_edit?cats=".$idCat);

            }else{
                $this->view->render("admin/items");
            }
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для добавление товаров
     */
    public function items_nextAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            if($this->adminproducts->isGet()){

                // Получение списка всех свойтв для данной категории
                $this->cat_id = isset($_GET['cats']) ? htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;
                $this->view->property = $this->adminproducts->getPropertiesProduct($this->cat_id);

                // Получение данных из формы
                $this->view->name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : '';
                $this->view->desc = isset($_POST['description']) ? htmlspecialchars(strip_tags(trim($_POST['description']))) : '';
                $this->view->price = isset($_POST['price']) ? htmlspecialchars(strip_tags(trim($_POST['price']))) : '';
                $this->idCat = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : '';
                $this->value = isset($_POST['value']) ? htmlspecialchars(strip_tags(trim($_POST['value']))) : '';
                $this->img = isset($_POST['img']) ? htmlspecialchars(strip_tags(trim($_POST['img']))) : '';

                if($this->admincatalog->isPost()){
                    $this->folder = $this->admincatalog->getFolder($this->idCat);
                    $validate = $this->adminproducts->isValidProducts($this->view->name, $this->view->desc, $this->view->price, $this->folder);
                    if($validate !== true){
                        $this->view->msg = $validate;
                    }else{
                        // Сохранение в бд
                        $save = $this->adminproducts->saveProduct($this->view->name, $this->view->desc, $this->view->price, $this->idCat, $this->adminproducts->uploadfile);
                        if(!$save){
                            $this->view->errors = "Не удалось сохранить в бд";
                        }else{
                            $this->redirect(APP_BASE_URL."admin/items");
                        }
                    }
                }
            }
            $this->view->render("admin/items_next");
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для удаление товаров
     */
    public function items_deleteAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $this->catId = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;

            // Получени списка всех товаров для данной категории
            $this->view->products = $this->adminproducts->getProducts($this->catId);

            if($this->isPost()){
                $idProducts = isset($_POST['id']) ? (int) htmlspecialchars(strip_tags(trim($_POST['id']))) : null;

                // Удаление товара из бд
                $delete = $this->adminproducts->deleteProducts($idProducts);
                if(!$delete){
                    $this->msg = "Не удалось удалить товар";
                }else{
                    $this->redirect(APP_BASE_URL."admin/items");
                }
            }else{
                $this->view->render("admin/items_delete");
            }
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для редактирование товаров
     */
    public function items_editAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $this->view->catId = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;
            $id = isset($_POST['id']) ? (int) htmlspecialchars(strip_tags(trim($_POST['id']))) : null;

            // Получени списка всех товаров для данной категории
            $this->view->products = $this->adminproducts->getProducts($this->view->catId);

            if($this->isPost()){
                $this->redirect(APP_BASE_URL."admin/items_edit_next?cats=".$this->view->catId."&"."id=".$id);
            }else{
                $this->view->render("admin/items_edit");
            }
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    public function items_edit_nextAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $this->view->msg = array();
            $this->catId = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;
            $this->view->id = isset($_GET['id']) ? (int) htmlspecialchars(strip_tags(trim($_GET['id']))) : null;

            // Получение значений свойств
            $this->view->valueProperties = $this->adminproducts->getProductProperties($this->view->id);

            // Значения свойств для представления
            foreach($this->view->valueProperties as $valueProperty){
                $this->view->name = $valueProperty['name'];
                $this->view->description = $valueProperty['description'];
                $this->view->price = $valueProperty['price'];
                $this->view->img = $valueProperty['img'];
            }

            // Получение данных из формы
            $this->view->id = isset($_GET['id']) ? (int) htmlspecialchars(strip_tags(trim($_GET['id']))) : null;
            $this->name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : null;
            $this->description = isset($_POST['description']) ? htmlspecialchars(strip_tags(trim($_POST['description']))) : null;
            $this->price = isset($_POST['price']) ? htmlspecialchars(strip_tags(trim($_POST['price']))) : null;
            $this->img = isset($_POST['img']) ? htmlspecialchars(strip_tags(trim($_POST['img']))) : null;

            if(isset($_POST['submit'])){

                $this->folder = $this->admincatalog->getFolder($this->catId);

                $validate = $this->adminproducts->isValidEditProducts($this->name, $this->description, $this->price, $this->folder);
                if($validate == true){

                    // Обновление данных в бд
                    $update = $this->adminproducts->alterProduct($this->view->id, $this->name, $this->description, $this->price, $this->catId, $this->adminproducts->uploadfile);
                    if(!$update){
                        $this->view->msg = "Не удалось отредактировать товар";
                    }else{
                        $this->redirect(APP_BASE_URL."admin/items");
                    }
                }else{
                    $this->view->msg = $validate;
                }
            }
            $this->view->render("admin/items_edit_next");

        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }
    /**
     * Экшн для свойств товаров
     */
    public function propertiesAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            // Получение всех категорий
            $this->view->catalog = $this->admincatalog->getCategory();

            // Проверяет была ли отправлена форма
            if($this->admincatalog->isGet()){

                // Экшн для выбора категории
                $this->properties_nextAction();
            }else{
                $this->view->render("admin/properties");
            }
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для выбора категории
     */
    public function properties_nextAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $this->view->idCat = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;

            $this->view->properties = $this->adminproducts->getProperiesCategory($this->view->idCat);

            $this->view->render("admin/properties_next");
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для добавления характеристик
     */
    public function properties_next_addAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $idCat = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;

            $this->view->name = isset($_POST['property']) ? htmlspecialchars(strip_tags(trim($_POST['property']))) : null;
            $this->view->for_input = isset($_POST['for_input']) ? htmlspecialchars(strip_tags(trim($_POST['for_input']))) : null;

            if(isset($_POST['submit'])){
                $val = $this->adminproducts->validateNewProperty($this->view->name, $this->view->for_input);
                if($val !== true){
                    $this->view->msg = $val;
                }else{
                    $add = $this->adminproducts->addProperty($this->view->name, $idCat, $this->view->for_input);
                    if(!$add){
                        $this->view->msg = "Не удалось добавить свойство";
                    }else{
                        $this->redirect(APP_BASE_URL."admin/properties");
                    }
                }
            }
                $this->view->render("admin/properties_next_add");

        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для удаления характеристик
     */
    public function properties_next_deleteAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $idCat = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;
            $this->view->properties = $this->adminproducts->getProperiesCategory($idCat);

            $ids = isset($_POST['id']) ? (int) htmlspecialchars(strip_tags(trim($_POST['id']))) : null;

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
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для редактирования характеристик
     */
    public function properties_next_editAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $this->view->catId = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;
            $this->view->properties = $this->adminproducts->getProperiesCategory($this->view->catId);

            $id = isset($_GET['id']) ? (int) htmlspecialchars(strip_tags(trim($_GET['id']))) : null;

            if(isset($_GET['edit'])){
                $this->redirect(APP_BASE_URL."admin/properties_next_edit_next?id=".$id."&idCat=".$this->view->catId);
            }else{
                $this->view->render("admin/properties_next_edit");
            }
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для дальнейшего редактирования характеристик
     */
    public function properties_next_edit_nextAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $id = isset($_GET['id']) ? (int) htmlspecialchars(strip_tags(trim($_GET['id']))) : null;
            $idCat = isset($_GET['idCat']) ? (int) htmlspecialchars(strip_tags(trim($_GET['idCat']))) : null;

            // Получение значений для формы из бд
            $props = $this->adminproducts->getDataProperty($id);

            $this->view->property = $props['property'];
            $this->view->for_input = $props['for_input'];

            // Получение данных из формы
            $property = isset($_POST['property']) ? htmlspecialchars(strip_tags(trim($_POST['property']))) : null;
            $for_input = isset($_POST['for_input']) ? htmlspecialchars(strip_tags(trim($_POST['for_input']))) : null;

            if(isset($_POST['submit'])){
                $val = $this->adminproducts->validateNewProperty($property, $for_input);
                if($val !== true){
                    $this->view->msg = $val;
                }else{
                    $edit = $this->adminproducts->editProperty($id, $property, $idCat, $for_input);
                    if(!$edit){
                        $this->view->msg = "Не удалось отредактировать свойство";
                    }else{
                        $this->redirect(APP_BASE_URL."admin/properties");
                    }
                }
            }
                $this->view->render("admin/properties_next_edit_next");

        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для добавления новой категории
     */
    public function catalog_addAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            $this->view->msg = '';

            // Получение данных из формы
            $this->admincatalog->getData();

            $this->view->folder = $this->admincatalog->folder;
            $this->view->name = $this->admincatalog->name;
            $this->view->description = $this->admincatalog->description;

            // Проверяет бы ли отправлена форма
            if($this->admincatalog->isPost()){

                // Валидация формы, если прошла то добавляет новую категорию в бд, иначе выводит сообщение об ошибке
                $validate = $this->admincatalog->isValid($this->view->folder);

                if($validate !== true){

                    // Получение всех ошибок
                    $this->view->msg = $validate;
                }else{
                    // Добавление новой категории
                    $save = $this->admincatalog->addCategory($this->admincatalog->name, $this->admincatalog->description, $this->admincatalog->uploadfile, $this->view->folder);

                    if(!$save){
                        $this->view->msg = 'Не удалось сохранить';
                    }else{
                        $this->redirect(APP_BASE_URL."admin/catalog");
                    }
                }
            }
            $this->view->render("admin/catalog_add");
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для удаления категории
     */
    public function catalog_deleteAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            // Получение списка всех категорий
            $this->view->catalog = $this->admincatalog->getCategory();

            // Проверяет была ли отправлена форма
            if($this->admincatalog->isPost()){

                // Получение ид выбранных категорий
                $this->admincatalog->getCatsId();

                // Удаление категорий
                $this->admincatalog->deleteCategory($this->admincatalog->catsId);
                $this->redirect("catalog_delete");
            }
            $this->view->render("admin/catalog_delete");
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для выбора редактируемой категории
     */
    public function catalog_editAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){

            // Получение всех категорий
            $this->view->catalog = $this->admincatalog->getCategory();

            $catId = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : null;
            // Проверяет была ли отправлена форма
            if($this->admincatalog->isGet()){

                // Вызывает экшн редактирования категорий
                $this->redirect("catalog_edit_next?cats=".$catId);
            }else{
                $this->view->render("admin/catalog_edit");
            }
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Экшн для редактирования категорий
     */
    public function catalog_edit_nextAction(){

        // Проверка залогирован ли админ
        if($this->session->isLoggedIn()){
            // Проверяет есть ли данные в методе GET
            if($this->admincatalog->isGet()){

                // Получение ид выбранной категории
                $this->id = isset($_GET['cats']) ? (int) htmlspecialchars(strip_tags(trim($_GET['cats']))) : '';

                // Получение свойств выбранной категории
                $propertyCategory = $this->admincatalog->getOneCategory($this->id);

                // Получение данных для представления
                $this->view->id = isset($_POST['id']) ? htmlspecialchars(strip_tags(trim($_POST['id']))) : $propertyCategory['id'];
                $this->view->name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : $propertyCategory['name'];
                $this->view->description = isset($_POST['description']) ? htmlspecialchars(strip_tags(trim($_POST['description']))) : $propertyCategory['description'];
                $this->view->folder = isset($_POST['folder']) ? htmlspecialchars(strip_tags(trim($_POST['folder']))) : $propertyCategory['folder'];

                // Получение данных из формы
                $this->admincatalog->getData();

                // Проверяет была ли отправлена форма
                if($this->admincatalog->isPost()){

                    // Валидация данных
                    $validate = $this->admincatalog->isValid2();
                    $this->admincatalog->folder = $this->admincatalog->getFolder($this->id);
                    // Вывод ошибок, если не прошла валидация, и сохранение данных, если все хорошо
                    if($validate !== true){
                        $this->view->msg = $validate;
                    }else{

                        // Если файл для загрузки не менялся, то выполняется первый скрипт, иначе второй
                        if(isset($this->admincatalog->uploadfile)){
                            $save = $this->admincatalog->editCategory($this->view->id, $this->admincatalog->name, $this->admincatalog->description, $this->admincatalog->folder);
                        }else{
                            $save = $this->admincatalog->editCategory($this->view->id, $this->admincatalog->name, $this->admincatalog->description, $this->admincatalog->folder, $this->admincatalog->uploadfile);
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
        }else{
            $this->redirect(APP_BASE_URL."admin/auth");
        }
    }

    /**
     * Проверка была ли отправлена форма POST
     * @return bool
     */
    public function isPost(){
        return (isset($_POST) && !empty($_POST));
    }

}
