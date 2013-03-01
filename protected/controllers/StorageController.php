<?php
class StorageController extends Controller
{
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
        );
    }

    public function actionIndex(){
        $record = ReceiveRecord::model()->findByPk(1000000);
        echo $record->provider->name;
    }

    public function actionOutstock(){
        $this->getRecordList(Record::OUT_RECORD);
    }

    public function actionInstock(){
        $this->getRecordList(Record::IN_RECORD);
    }

    private function getRecordList($type, $goods_number = null){
        $criteria = new CDbCriteria();

        $criteria->order = "id desc";

        $record = new Record($type);
        $count = $record->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $recordList = $record->findAll($criteria);

        $this->cs->registerScriptFile($this->jsCommon."RecordHelper.js");
        $this->cs->registerScriptFile($this->jsCommon."selectProvider.js");

        $this->render("instock", array(
            'type' => $type,
            'recordList' => $recordList,
            'pages' => $pages,
        ));

    }

    public function actionCreateinstock(){
        $this->createRecord("入");
    }

    public function actionCreateoutstock(){
        $this->createRecord("出");
    }

    private function createRecord($actionType){
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsCommon."selectProvider.js");
        $this->render("createInStock", array(
            'actionType' => $actionType
        ));
    }

    public function actionPrintRecordList(){
        $this->layout = "//layouts/blank";
        if(isset($_GET['id']) && isset($_GET['type'])){
            $recordContent = new RecordContent();
            $recordList = $recordContent->getRecordContent($_GET['id'],$_GET['type']);
            $info = $recordContent->printInfomation($_GET['id'],$_GET['type']);

            $this->render("printRecordContent", array(
                "recordList" => $recordList,
                "info" => $info
            ));
        }
    }

    public function actionSearch(){
        $criteria = RecordContent::getCriteria($_GET,$_GET['type']);

        $record = new Record($_GET['type']);
        $count = $record->count($criteria);

        $pages = new CPagination($count);

        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $recordList = $record->findAll($criteria);

        $this->cs->registerScriptFile($this->jsCommon."RecordHelper.js");
        $this->cs->registerScriptFile($this->jsCommon."selectProvider.js");

        $this->render("instock", array(
            'type' => $_GET['type'],
            'recordList' => $recordList,
            'pages' => $pages,
        ));

    }
}
