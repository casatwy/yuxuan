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
                'actions' => array('index', 'resource', 'instock', 'createinstock'),
                'users' => array('@')
            ),
            array(
                'deny',
                'users' => array('*')
            ),
        );
    }

    public function actionIndex(){
        echo time();
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
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->jsUrl."createInStock.js");
        $this->render("createInStock", array(
            'type' => $type,
        ));
    }
}
