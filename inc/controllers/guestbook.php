<?php

Class GuestbookController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function indexAction(){

        // Получение данных с формы
        $this->guestbook->getData();

        // Проверка отправки формы
        if($this->guestbook->isPost()){

            // Получаем данные для представления
            $this->view->name = $this->guestbook->name;
            $this->view->email = $this->guestbook->email;
            $this->view->message = $this->guestbook->message;
            $this->view->captcha = $this->guestbook->captcha;

            $valid = $this->guestbook->isValid();

            // Проверка валидации формы
            if($valid !== true){
                // Вывод ошибок
                $this->view->msg = $this->guestbook->getErrors();
            }else{
                // Сохранение данных
                $this->guestbook->save($this->guestbook->name, $this->guestbook->email, $this->guestbook->message);

                // Перенаправление на текущую страницу
                header('Location: '.$_SERVER['REQUEST_URI']);
            }
        }

        // Генерация капчи
        $this->view->captcha_form = GuestbookModel::generateCapcha();

        // Получение всех сообщений
        $this->view->storage = $this->storage->getStorage();

        // Получение количества сообщений
        $storageSize = $this->storage->getStorageSize();

        // Получение дефолтных значений для страницы
        $pageNum = isset($_GET['page']) ? (int)$_GET['page']: 1;

        // Подсчет количества страниц
        $pageCount = $this->paginator->getCountPage($storageSize);

        // Получение среза сообщений
        $this->view->messages = $this->paginator->getNumPage($pageNum, 15);

        $this->view->pagination = $this->paginator->getPaginatorHtml($pageCount);

        // Перенаправление на страницу с гостевой книгой
        $this->view->render('guestbook/index');
    }
}