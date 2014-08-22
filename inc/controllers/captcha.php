<?php

class captchaController extends Controller{

    public function indexAction(){
        $this->show();
    }

    public function show(){
        $captcha = ContactModel::generateCapcha();

        $pic = new ImageModel;
        return $pic->setText($captcha)->send();

    }
}