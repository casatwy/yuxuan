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
        $this->getRecordList(self::OUT_RECORD);
    }

    public function actionInstock(){
        $this->getRecordList(self::IN_RECORD);
    }

    private function getRecordList($type){
        $model = null;
        if($type == self::OUT_RECORD){
            $model = "ReceiveRecord";
        }
        if($type == self::IN_RECORD){
            $model = "DeliverRecord";
        }

        $criteria = new CDbCriteria();

        $count = ($type == self::OUT_RECORD)?(DeliverRecord::model()->count($criteria)):(ReceiveRecord::model()->count($criteria));
        $pages = new CPagination($count);

        $pages->pageSize = 3;
        $pages->applyLimit($criteria);
        $recordList = ($type == self::OUT_RECORD)?(DeliverRecord::model()->findAll($criteria)):(ReceiveRecord::model()->findAll($criteria));

        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsCommon."RecordHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."instock.js");

        $this->render("instock", array(
            'type' => $type,
            'recordList' => $recordList,
            'pages' => $pages,
        ));

    }

    public function actionCreateinstock(){
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."createInStock.js");
        $this->render("createInStock", array(
			'sort' => 'instock',	
            'type' => $type,
        ));
    }

    public function actionCreateoutstock(){
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."createInStock.js");
        $this->render("createInStock",array(
			'sort' => 'outstock',	
            'type' => $type,
        ));
    }

    private function createRecord($actionType){
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsUrl."createInStock.js");
        $this->render("createOutStock",array(
            'type' => $type,
        ));
    }
}
