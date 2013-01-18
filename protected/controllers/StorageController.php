<?php

class StorageController extends Controller
{
    const OUT_RECORD = 1;
    const IN_RECORD = 2;

    public function init(){
        parent::init();
        $this->layout = "//layouts/storage";
        $this->defaultAction = "instock";
    }

    public function filters(){
        return array('accessControl');
    }

    public function accessRules(){
        return array(
            array(
                'allow',
                'actions' => array('index', 'resource', 'instock', 'outstock', 'createinstock', 
									'createoutstock', 'product', 'printrecordlist'),
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
        $criteria = new CDbCriteria();
        $criteria->order = "id desc";

        $count = ($type == self::OUT_RECORD)?(DeliverRecord::model()->count($criteria)):(ReceiveRecord::model()->count($criteria));
        $pages = new CPagination($count);

        $pages->pageSize = 10;
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
        $this->createRecord("instock");
    }

    public function actionCreateoutstock(){
        $this->createRecord("outstock");
    }

    private function createRecord($actionType){
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->render("createInStock",array(
            'sort' => $actionType,
            'type' => $type,
        ));
    }

	public function actionPrintRecordList(){
        $this->layout = "//layouts/blank";
        if(isset($_GET['id']) && isset($_GET['type'])){
			$recordContent = new RecordContent();
        	$recordList = $recordContent->getRecordContent($_GET['id'],$_GET['type']);

			if($_GET['type'] == self::IN_RECORD){
				$record = ReceiveRecord::model()->findByPk($_GET['id']);
			}elseif($_GET['type'] == self::OUT_RECORD){
				$record = DeliverRecord::model()->findByPk($_GET['id']);
			} 

        	$condition = "name=:name";
        	$params = array(
        	    ":name" => $record->record_maker,
        	);
        	$user = Users::model()->find($condition, $params);
			$info = array(
				"type" => $_GET['type'],
				"record" => $record,
				"user" => $user
			);
            $this->render("printRecordContent", array(
                "recordList" => $recordList,
				"info" => $info
            ));
        }
	}
}
