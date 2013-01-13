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
                'actions' => array('resource', 'instock', 'outstock', 'createinstock', 'createoutstock'),
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

    public function actionOutstock(){
        $this->render("outstock");
    }

    public function actionInstock(){
        $this->cs->registerScriptFile($this->jsUrl."instock.js");
        $this->render("instock");
    }

    public function actionCreateinstock(){
        $providerArray = $this->generateProviderArray();
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."createInStock.js");
        $this->render("createInStock", array(
            'type' => $type,
            'providerArray' => $providerArray,
        ));
    }

    public function actionCreateoutstock(){
        $providerArray = $this->generateProviderArray();
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."createOutStock.js");
        $this->render("createOutStock",array(
            'type' => $type,
            'providerArray' => $providerArray,
        ));
    }

    private function generateProviderArray(){
        return array();
    }
}
