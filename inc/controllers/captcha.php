<?php

class captchaController extends Controller{

    /**
     * Базовый экшн
     */
    public function indexAction(){
        $this->show();
    }

    /**
     * Метод генерации изображения для капчи
     */
    public function show(){
        $captcha = ContactModel::generateCapcha();

        $pic = new ImageModel;
        return $pic->setText($captcha)->send();

    }
}