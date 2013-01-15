<?php

class StorageController extends Controller
{
    const OUT_RECORD = 1;
    const IN_RECORD = 2;

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
                'actions' => array('index', 'resource', 'instock', 'outstock', 'createinstock', 'createoutstock','product'),
                'users' => array('@')
            ),
            array(
                'deny',
                'users' => array('*')
            ),
        );
    }

    public function actionIndex(){
        $record = ReceiveRecord::model()->findByPk(1000000);
        echo $record->provider->name;
    }

    public function actionResource()
    {
        $this->render("resource");
    }

    public function actionProduct()
    {
        $this->render("resource");
    }

    public function actionOutstock(){
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsCommon."RecordHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."instock.js");
        $this->render("instock", array(
            'type' => self::OUT_RECORD
        ));
    }

    public function actionInstock(){
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsCommon."RecordHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."instock.js");

        $criteria = new CDbCriteria();

        $count = ReceiveRecord::model()->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = 3;
        $pages->applyLimit($criteria);
        $recordList = ReceiveRecord::model()->findAll($criteria);

        $this->render("instock", array(
            'type' => self::IN_RECORD,
            'recordList' => $recordList,
            'pages' => $pages,
        ));
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
