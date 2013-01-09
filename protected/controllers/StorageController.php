<?php

class StorageController extends Controller
{
    public function init(){
        parent::init();
        $this->layout = "//layouts/storage";
        $this->defaultAction = "resource";
    }

    public function filters(){
        return array('accessControl');
    }

    public function accessRules(){
        return array(
            array(
                'allow',
                'actions' => array('resource', 'instock', 'createinstock'),
                'users' => array('@')
            ),
            array(
                'deny',
                'users' => array('*')
            ),
        );
    }

    public function actionResource()
    {
        $this->render("resource");
    }

    public function actionInstock(){
        $this->cs->registerScriptFile($this->jsUrl."instock.js");
        $this->render("instock");
    }

    public function actionCreateinstock(){
        $this->render("createInStock");
    }
}
