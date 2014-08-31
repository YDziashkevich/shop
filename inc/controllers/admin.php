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
        if($this->admincatalog->isGet()){

            // Вызов экшна добавления товаров
            $this->items_nextAction();

        }else{

            $this->view->render("admin/items");
        }
    }

    /**
     * Экшн для добавление товаров
     */
    public function items_nextAction(){

        if($this->admincatalog->isGet()){

            $this->cat_id = isset($_GET['cats']) ? $_GET['cats'] : null;
            $this->view->property = $this->admincatalog->getPropertiesProduct($this->cat_id);
            $this->name = isset($_POST['name']) ? $_POST['name'] : '';
            $this->desc = isset($_POST['description']) ? $_POST['description'] : '';
            $this->price = isset($_POST['price']) ? $_POST['price'] : '';
            $this->idCat = isset($_GET['cats']) ? $_GET['cats'] : '';
            $this->value = isset($_POST['value']) ? $_POST['value'] : '';
            $this->img = isset($_POST['img']) ? $_POST['img'] : '';

            if($this->admincatalog->isPost()){
                $validate = $this->admincatalog->isValidProducts();
                var_dump($this->admincatalog->uploadfile);
                if(!$validate){
                    $this->view->msg = $validate;
                }else{
                    $save = $this->admincatalog->saveProduct($this->name, $this->desc, $this->price, $this->idCat, $this->admincatalog->uploadfile);
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
     * Экшн для свойств товаров
     */
    public function propertiesAction()
    {
        $this->view->render("admin/properties");
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
                    die;
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

}
