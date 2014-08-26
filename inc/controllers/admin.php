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

    public function indexAction()
    {
        $this->view->render("admin/index");
    }

    public function catalogAction()
    {
        $this->view->catalog = $this->admincatalog->getCategory();

        $this->view->render("admin/catalog");


    }

    public function itemsAction()
    {
        $this->view->render("admin/items");
    }

    public function propertiesAction()
    {
        $this->view->render("admin/properties");
    }

    public function securityAction()
    {
        $this->view->render("admin/security");
    }

    public function catalog_addAction()
    {
        $this->view->msg = '';

        $this->admincatalog->getData();

        $this->view->name = $this->admincatalog->name;
        $this->view->description = $this->admincatalog->description;

        if($this->admincatalog->isPost()){
            $validate = $this->admincatalog->isValid();
            if($validate !== true){
                $errors = implode('<br />', $validate);
                $this->view->msg = $errors;
            }else{
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

    public function catalog_deleteAction(){

        $this->view->catalog = $this->admincatalog->getCategory();

        if($this->admincatalog->isPost()){
            $this->admincatalog->getCatsId();

            $this->admincatalog->deleteCategory($this->admincatalog->catsId);
            $this->redirect("catalog_delete");
        }


        $this->view->render("admin/catalog_delete");
    }

    public function catalog_editAction(){

        $this->view->catalog = $this->admincatalog->getCategory();

        if($this->admincatalog->isGet()){


            $this->catalog_edit_nextAction();
        }else{
            $this->view->render("admin/catalog_edit");
        }


    }

    public function catalog_edit_nextAction(){

        if($this->admincatalog->isGet()){
            $this->id = isset($_GET['cats']) ? $_GET['cats'] : '';
            $propertyCategory = $this->admincatalog->getOneCategory($this->id);

            $this->view->id = isset($_POST['id']) ? $_POST['id'] : $propertyCategory['id'];
            $this->view->name = isset($_POST['name']) ? $_POST['name'] : $propertyCategory['name'];
            $this->view->description = isset($_POST['description']) ? $_POST['description'] : $propertyCategory['description'];

            $this->admincatalog->getData();

            if($this->admincatalog->isPost()){
                $validate = $this->admincatalog->isValid2();
                if($validate !== true){
                    $errors = implode('<br />', $validate);
                    $this->view->msg = $errors;
                }else{

                    if(!isset($this->admincatalog->uploadfile)){
                        $save = $this->admincatalog->editCategory($this->view->id, $this->admincatalog->name, $this->admincatalog->description);

                    }else{
                        $save = $this->admincatalog->editCategory($this->view->id, $this->admincatalog->name, $this->admincatalog->description, $this->admincatalog->uploadfile);
                    }

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