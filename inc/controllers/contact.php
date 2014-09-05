<?php

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Подлючение модели контактов
        $contact = new ContactModel();
        $this->contact = $contact;
        $this->view->contact = $this->contact;
    }

    public function indexAction()
    {
        // Получение данных с формы
        $this->contact->getData();

        // Проверка отправки формы
        if($this->contact->isPost()){

            // Получаем данные для представления
            $this->view->name = $this->contact->name;
            $this->view->email = $this->contact->email;
            $this->view->topic = $this->contact->topic;
            $this->view->message = $this->contact->message;
            $this->view->captcha = $this->contact->captcha;

            $valid = $this->contact->isValid();

            // Проверка валидации формы
            if($valid !== true){
                // Вывод ошибок
                $this->view->msg = $this->contact->getErrors();
            }else{
                // Сохранение данных
                $this->contact->save($this->contact->name, $this->contact->email, $this->contact->topic, $this->contact->message);

                // Перенаправление на текущую страницу
                header('Location: '.$_SERVER['REQUEST_URI']);
                die;
            }
        }

        // Генерация капчи
        $this->view->captcha_form = contactModel::generateCapcha();

        $this->view->render("contact/index");
    }

}