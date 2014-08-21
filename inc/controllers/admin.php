<?php

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render("admin/index");
    }

    public function catalogAction()
    {
        $this->view->catalog = $this->admincatalog->getCategory();

        if($this->admincatalog->isAdd()){
            $this->redirect(APP_BASE_URL."admin/catalog_add");
        }else{
            $this->view->render("admin/catalog");
        }

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

        if($this->admincatalog->isSubmit()){
            $validate = $this->admincatalog->isValid();
            if($validate !== true){
                $errors = implode('<br />', $validate);
                $this->view->msg = $errors;
            }else{
                $save = $this->admincatalog->addCategory($this->admincatalog->name, $this->admincatalog->description);
                if(!$save){
                    $this->view->msg = 'Не удалось сохранить';
                }else{
                    $this->redirect(APP_BASE_URL."admin/catalog");
                }
            }
        }

        $this->view->render("admin/catalog_add");
    }

}